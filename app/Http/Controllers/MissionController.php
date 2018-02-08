<?php

namespace App\Http\Controllers;

use App\Dict;
use App\Enums\DictTypes;
use App\Http\Requests\MissionRequest;
use App\Mission_template;
use App\Helper\Util;
use App\Staff;
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
        $query = $this->applyFilters(Mission::query());
        $missions = $query->show()->orderBy('status')->orderBy('created_at','desc')->paginate($this->pageNumber());
        $posts = Dict::where('type',DictTypes::STAFF_POST)->get();
        $status = Dict::where('type',DictTypes::MISSION_STATUS)->get();
        $template = Mission_template::all(['id','name']);
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
        $posts = Dict::where('type',DictTypes::STAFF_POST)->get();
        $arithmetic = Dict::where('type',DictTypes::MISSION_ARITHMETIC)->get();
        $template_id && $tem = Mission_template::findOrFail($template_id);

        return view('mission.create',compact('posts','arithmetic','tem'));
    }


    public function choose()
    {
        $templates = Mission_template::paginate($this->pageNumber());
        return view('mission_template.choose',compact('templates'));
    }



    public function assign($id)
    {
        $mission = Mission::findOrfail($id);
        $query = Staff::query()->where('post',$mission->post_id);
        $query->orderBy('status')->orderBy('mission_status');
        $staffs = $query->paginate($this->pageNumber());
        return view('mission.assign',compact('mission','staffs'));
    }

    /**
     * @param Request $request
     * @param $id
     * @param data
     * @param data[amount]
     * @param data[staff_id]
     * @param data[start_time]
     * @param data[end_time]
     * @return array
     */
    public function division(Request $request,$id)
    {
        $mission = Mission::findOrFail($id);
        $data = $request->get('data');
        if (empty($data))
            return ['code' => 400,'data' => '未选择任务分配成员'];
        $sum = collect($data)->sum('amount');
        if ($sum > $mission->amount)
            return ['code' => 400,'data' => '任务分配总量高于任务量'];

        foreach ($data as $datum){
            $amount = $datum['amount'];
            if ( $amount > $mission->upper)
                return ['code' => 400,'data' => '任务量高于任务上限'];
            if (count($data) == 1 && $amount == $mission->amount){
                //如果仅把此任务分配给了一个人
                $mission->update(collect($datum)->intersect($mission->getFillable())->toArray());
            }else{
                //分割任务
                $insert = array_merge($mission->getAttributes(),$datum);
                unset($insert['id']);
                $insert['status'] = Dict::ofCode('doing')->first()->id;
                $insert['name'] = $this->getMissionName($mission->name);
                $insert['parent_id'] = $mission->id;
                Mission::insert($insert);

                $staff = Staff::find($datum['staff_id']);
                //修改员工的任务状态为任务中
                $staff->mission_status = Dict::where('code','missioning')->first()->id;
                $staff->save();
            }
        }

        if ($sum < $mission->amount){
            //任务量有剩余
            $insert = array_merge($mission->getAttributes(),[
                'parent_id' => $mission->id,
                'amount' => $mission->amount - $sum,
                'upper' => ($mission->amount - $sum) > $mission->upper ? $mission->upper : $mission->amount - $sum,
                'name' => $this->getMissionName($mission->name)
            ]);
            unset($insert['id']);
            Mission::insert($insert);
        }

        if (! (count($data) == 1 && $sum == $mission->amount)) {
            //修改原任务
            $mission->status = Dict::ofCode('close')->first()->id;
            $mission->save();
        }
        return url("mission");
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
        $posts = Dict::where('type',DictTypes::STAFF_POST)->get();
        $status = Dict::where('type',DictTypes::MISSION_STATUS)->where('code','!=','close')->get();
        $arithmetic = Dict::where('type',DictTypes::MISSION_ARITHMETIC)->get();
        $staffs = Staff::where('post',$mission->post_id)
            ->where('mission_status',Dict::ofCode('no_mission')->first()->id)
            ->where('status',Dict::ofCode('work')->first()->id)
            ->get();
        return view('mission.edit',compact('title','mission','posts','status','arithmetic','staffs'  ));
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
