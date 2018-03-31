<?php

namespace App\Http\Controllers;

use App\Dict;
use App\Enums\DictCodes;
use App\Enums\DictTypes;
use App\Http\Requests\MissionRequest;
use App\Log;
use App\Mission_template;
use App\Helper\Util;
use App\MissionSwitch;
use App\Post;
use App\Staff;
use App\StaffWorkLog;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Mission;
use URL;

/**
 * Class MissionController.
 *
 * @author  The scaffold-interface created at 2018-01-20 09:33:28am
 * @link  https://github.com/amranidev/scaffold-interface
 */
class MissionController extends Controller
{
    use Util;
    /**
     * Display a listing of the resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $title = 'Index - mission';
        $query = $this->applyFilters(Mission::query()->where('is_template',false));
        $missions = $query->show()->orderBy('status')->orderBy('created_at','desc')->paginate($this->pageNumber());
        $posts = Dict::where('type',DictTypes::STAFF_POST)->get();
        $status = Dict::where('type',DictTypes::MISSION_STATUS)->get();
        return view('mission.index',compact('missions','title','posts','status','template'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function create(Request $request,$id = null)
    {
        $template_id = $request->get('template_id');
        info($template_id);
        $posts = Dict::where('type',DictTypes::STAFF_POST)->get();
        $arithmetic = Dict::where('type',DictTypes::MISSION_ARITHMETIC)->get();
        $template_id && $tem = Mission_template::findOrFail($template_id);

        return view('mission.create',compact('posts','arithmetic','tem'));
    }

    public function assign($id)
    {
        $mission = Mission::findOrfail($id);
        $post = Post::find($mission->post_id);

        $staffs = $post ? $post->staffs()->get(): Staff::get();
        $staffs->flatMap(function ($model){
            $model->mission_rt = 0; //员工正在进行的任务的剩余所需时间
            $mission = $model->missions()->where('status',Dict::ofCode('doing')->first()->id)->first();
            if ($mission ){
                $model->mission_rt = $mission->sustain - $mission->consuming;
            }
            $model->save();
            return $model;
        });
        $staffs = $post ? $post->staffs(): Staff::query();
        $staffs = $staffs->orderBy('status')->orderBy('mission_status','desc')->orderBy('mission_rt')->get();
        $priority = Dict::ofType(DictTypes::MISSION_PRIORITY)->get();

        if ($mission->device){
            $count = Mission::where('status',Dict::ofCode(DictCodes::MISSION_STATUS_DOING)->first()->id)
                ->where('device_id',$mission->device_id)->count();
            $number = ($mission->device->amount - $count) >= 0 ? ($mission->device->amount - $count): 0;
            \Session::flash('message',"$count 台 ".$mission->device->name.' 正在使用中,剩余可用:'.$number);
        }

        return view('mission.assign',compact('mission','staffs','priority'));
    }

    /**
     * 发布任务
     * @param Request $request
     * @param $id
     * @return array
     */
    public function division(Request $request,$id)
    {
        info($request->all());
        $mission = Mission::findOrFail($id);
        $data = $request->get('data');
        $priority = $request->priority;
        if (empty($data))
            return ['code' => 400,'data' => '分配失败'];
        foreach ($data as $datum){
            $insert = array_merge($mission->getAttributes(),$datum);
            unset($insert['id']);
            $insert['status'] = Dict::ofCode('new')->first()->id;
            $insert['name'] = $this->getMissionName($request->mission_name);
            $insert['priority'] = $priority;
            $insert['is_template'] = false;
            $insert['sustain'] = ceil(($mission->sustain / $mission->upper) * $datum['amount']);
            $log_mission_id = Mission::insertGetId($insert);
            $data = [
                'mission_id' => $log_mission_id,
                'project' => '分配任务',
                'original' => '',
                'modification' => Staff::find($datum['staff_id'])->name,
                'created_at' => Carbon::now()->toDateTimeString()
            ];
            Log::insert($data);
        }

        return url("mission");
    }

    /**
     * 接单
     */
    public function start($id)
    {
        $model = Mission::findOrFail($id);
        $query = Mission::query()->where('staff_id',$model->staff_id);
        //判断是否有任务正在进行
        $doing_mission = (clone $query)->where('status',Dict::ofCode('doing')->first()->id)->first();
        $wait = Dict::query()->ofCode('wait')->first()->id;
        if ($doing_mission && $doing_mission->priority > $model->priority){
            $model->status = $wait;
        }else{
            if ($doing_mission && $doing_mission->priority < $model->priority){
                $doing_mission->status = $wait;
                app(MissionSwitch::class)->missionOff($doing_mission->id);
                $doing_mission->save();
            }
            app(MissionSwitch::class)->missionOn($model->id);
            $model->status = Dict::query()->ofCode('doing')->first()->id;

            $staff = Staff::find($model->staff_id);
            $staff->mission_status = Dict::query()->ofCode('missioning')->first()->id;
            $staff->save();

            if ($model->is_special == true){
                StaffWorkLog::updateOrCreate(
                    ['staff_id' => $staff->id, 'date' => Carbon::now()->toDateString()],
                    ['status' => Dict::ofCode(DictCodes::STAFF_STATUS_BUSINESS)->first()->id]
                );
            }
        }
        $model->start_time = Carbon::now()->toDateTimeString();
        $model->save();
        return redirect('mission')->with('success','接单成功');
    }

    /**
     * 任务完成
     */
    public function Complete($id)
    {
        $model = Mission::findOrFail($id);
        $query = Mission::query()->where('staff_id',$model->staff_id);

        $model->status = Dict::query()->ofCode('complete')->first()->id;
        $model->complete_time = Carbon::now()->toDateTimeString();
        $model->save();

        app(MissionSwitch::class)->missionOff($model->id);

        $wait_mission = (clone $query)->where('status',Dict::ofCode('wait')->first()->id)->orderBy('priority','desc')->first();
        if ($wait_mission ){
            $wait_mission->status = Dict::query()->ofCode('doing')->first()->id;
            $wait_mission->save();

            app(MissionSwitch::class)->missionOn($wait_mission->id);

            if ($wait_mission->is_special == true){
                StaffWorkLog::updateOrCreate(
                    ['staff_id' => $wait_mission->staff_id, 'date' => Carbon::now()->toDateString()],
                    ['status' => Dict::ofCode(DictCodes::STAFF_STATUS_BUSINESS)->first()->id]
                );
            }
        }else{
            $staff = Staff::find($model->staff_id);
            $staff->mission_status = Dict::query()->ofCode('no_mission')->first()->id;
            $staff->save();

            if ($model->is_special == true){
                StaffWorkLog::updateOrCreate(
                    ['staff_id' => $model->staff_id, 'date' => Carbon::now()->toDateString()],
                    ['status' => Dict::ofCode(DictCodes::STAFF_STATUS_WORk)->first()->id]
                );
            }

        }
        return redirect('mission')->with('success','任务已结算');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param    \Illuminate\Http\Request  $request
     * @return  \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $mission = new Mission();

        
        $mission->name = $request->name;

        
        $mission->post_id = $request->post_id;

        
        $mission->description = $request->description;

        
        $mission->status = Dict::where('type',DictTypes::MISSION_STATUS)->where('code','new')->first()->id;


        $mission->start_time = $request->start_time;


        $mission->end_time = $request->end_time;


        $mission->complete_time = $request->complete_time;


        $mission->amount = $request->amount;


        $mission->staff_id = $request->staff_id;


        $mission->upper = $request->upper;
        $mission->arithmetic = $request->arithmetic;
        $mission->sustain = $request->sustain;

        
        
        $mission->save();


        return redirect('mission');
    }

    public function showRemarkForm($id)
    {
        $mission = Mission::findOrfail($id);
        $title = "备注";
        return view('mission.remark',compact('title','mission'));
    }
    /**
     * Display the specified resource.
     *
     * @param    \Illuminate\Http\Request  $request
     * @param    int  $id
     * @return  \Illuminate\Http\Response
     */
    public function show($id,Request $request)
    {
        $title = 'Show - mission';

        if($request->ajax())
        {
            return URL::to('mission/'.$id);
        }

        $mission = Mission::findOrfail($id);
        return view('mission.show',compact('title','mission'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param    \Illuminate\Http\Request  $request
     * @param    int  $id
     * @return  \Illuminate\Http\Response
     */
    public function edit($id,Request $request)
    {
        $title = 'Edit - mission';
        if($request->ajax())
        {
            return URL::to('mission/'. $id . '/edit');
        }

        
        $mission = Mission::findOrfail($id);
        $posts = Post::get();
        $status = Dict::where('type',DictTypes::MISSION_STATUS)->where('code','!=','close')->get();
        $post=Post::find($mission->post_id);
        $query = $post->staffs();
        $staffs = $query->orderBy('status')->orderBy('mission_status')->get();
        return view('mission.edit',compact('title','mission','posts','status','staffs'  ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param    \Illuminate\Http\Request  $request
     * @param    int  $id
     * @return  \Illuminate\Http\Response
     */
    public function update($id,Request $request)
    {
        $mission = Mission::findOrfail($id);
    	
        $mission->fill($request->intersect(app(Mission::class)->getFillable()));
        
        
        $mission->save();

        return redirect('mission');
    }

    /**
     * Delete confirmation message by Ajaxis.
     *
     * @link      https://github.com/amranidev/ajaxis
     * @param    \Illuminate\Http\Request  $request
     * @return  String
     */
    public function DeleteMsg($id,Request $request)
    {
        $msg = Ajaxis::MtDeleting('Warning!!','Would you like to remove This?','/mission/'. $id . '/delete');

        if($request->ajax())
        {
            return $msg;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param    int $id
     * @return  \Illuminate\Http\Response
     */
    public function destroy($id)
    {
     	$mission = Mission::findOrfail($id);
     	$mission->delete();
        return redirect('mission');
    }
}
