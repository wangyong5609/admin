<?php

namespace App\Http\Controllers;

use App\Device;
use App\Helper\Util;
use App\Mission;
use Illuminate\Http\Request;

class DeviceController extends Controller
{
    use Util;
    /**
     * Display a listing of the resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function index()
    {
        $query = $this->applyFilters(Device::query());
        $devices = $query->paginate($this->pageNumber());
        return view('device.index',compact('devices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function create()
    {
        $title = '添加新设备';
        return view('device.create',compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param    \Illuminate\Http\Request  $request
     * @return  \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $mission_template = new Device();


        $mission_template->name = $request->name;


        $mission_template->amount = $request->amount;
        $mission_template->save();
        return redirect('devices');
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
        $title = 'Show - mission_template';

        if($request->ajax())
        {
            return URL::to('mission_template/'.$id);
        }

        $mission_template = Mission_template::findOrfail($id);
        return view('mission_template.show',compact('title','mission_template'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param    \Illuminate\Http\Request  $request
     * @param    int  $id
     * @return  \Illuminate\Http\Response
     */
    public function edit($id,Request $request)
    {
        $title = '修改设备';

        $device = Device::findOrfail($id);
        return view('device.edit',compact('title','device' ));
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
        $device = Device::findOrfail($id);

        $device->fill($request->intersect(app(Device::class)->getFillable()));


        $device->save();

        return redirect('devices');
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
        $msg = Ajaxis::MtDeleting('Warning!!','Would you like to remove This?','/mission_template/'. $id . '/delete');

        if($request->ajax())
        {
            return $msg;
        }
    }


    public function destroy($id)
    {
        $device = Device::findOrfail($id);
        if (Mission::where('device_id',$id)->exists()){
            return redirect('devices')->with('danger','此设备已使用，不可删除');
        }
        $device->delete();
        return redirect('devices');
    }
}
