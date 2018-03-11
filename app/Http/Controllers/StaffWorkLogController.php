<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/8
 * Time: 19:14
 */

namespace App\Http\Controllers;


use App\Staff;
use App\StaffWorkLog;
use Carbon\Carbon;
use Illuminate\Http\Request;

class StaffWorkLogController extends Controller
{

    public function store(Request $request)
    {
        $staffs = $request->staff_id;
        $status = $request->status;
        foreach ($staffs as $key=>$val){
            StaffWorkLog::query()->updateOrCreate(
                ['date' =>Carbon::now()->toDateString(),'staff_id' => $val],
                ['status' =>$status[$key]]
            );
            $model = StaffWorkLog::where(['date' =>Carbon::now()->toDateString(),'staff_id' => $val])->first();
            if ($model){
                $model->status = $status[$key];
                $model->disabled = false;
                $model->save();
            }else{
                StaffWorkLog::insert([
                    'date' =>Carbon::now()->toDateString(),'staff_id' => $val
                ]);
            }

            $staff = Staff::find($val);
            $staff->status = $status[$key];
            $staff->save();

        }
        return redirect('staff');
    }
}