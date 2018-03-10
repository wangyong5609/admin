<?php

namespace App\Http\Controllers;

use App\Dict;
use App\Enums\DictTypes;
use App\Helper\Util;
use App\Post;
use App\StaffWorkLog;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Staff;
use Amranidev\Ajaxis\Ajaxis;
use URL;

/**
 * Class StaffController.
 *
 * @author  The scaffold-interface created at 2018-01-20 09:30:44am
 * @link  https://github.com/amranidev/scaffold-interface
 */
class StaffController extends Controller
{
    use  Util;
    /**
     * Display a listing of the resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function index()
    {
        if ( ! StaffWorkLog::where('date',Carbon::now()->toDateString())->exists() && StaffWorkLog::where('date',Carbon::yesterday()->toDateString())->exists()){
            $data = StaffWorkLog::where('date',Carbon::yesterday()->toDateString())->get();
            $data->each(function ($datum){
                $datum->date = Carbon::now()->toDateString();
                $datum->disabled = true;
                array_except($datum,'id');
            });
            StaffWorkLog::insert($data->toArray());
        }

        $title = 'Index - staff';
        $query = $this->applyFilters(Staff::query());
        $staffs = $query->get();
        $status = Dict::ofType(DictTypes::STAFF_STATUS)->get();
        return view('staff.index',compact('staffs','title','status'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function create()
    {
        $posts = Post::get();
        return view('staff.create',compact('posts'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param    \Illuminate\Http\Request  $request
     * @return  \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $staff = new Staff();
        $posts = $request->posts;
        $staff->fill($request->intersect($staff->getFillable()));

        $staff->save();
        foreach ($posts as $post){
            $staff->posts()->attach($post);
        }
        return redirect('staff');
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
        $title = 'Show - staff';

        if($request->ajax())
        {
            return URL::to('staff/'.$id);
        }

        $staff = Staff::findOrfail($id);
        return view('staff.show',compact('title','staff'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param    \Illuminate\Http\Request  $request
     * @param    int  $id
     * @return  \Illuminate\Http\Response
     */
    public function edit($id,Request $request)
    {
        $title = 'Edit - staff';
        if($request->ajax())
        {
            return URL::to('staff/'. $id . '/edit');
        }

        
        $staff = Staff::findOrfail($id);
        $posts = Post::get();
        $status = Dict::where('type',DictTypes::STAFF_STATUS)->get();
        return view('staff.edit',compact('title','staff','posts','status'  ));
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
        $staff = Staff::findOrfail($id);

        $staff->fill($request->intersect(app(Staff::class)->getFillable()));
        
        $staff->save();
        $staff->posts()->detach();
        $posts = $request->posts;
        foreach ($posts as $post){
            $staff->posts()->attach($post);
        }
        return redirect('staff');
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
        $msg = Ajaxis::MtDeleting('Warning!!','Would you like to remove This?','/staff/'. $id . '/delete');

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
     	$staff = Staff::findOrfail($id);
     	$staff->delete();
        return redirect('staff');
    }
}
