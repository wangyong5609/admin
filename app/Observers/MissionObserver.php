<?php
/**
 * Created by PhpStorm.
 * User: zhangzhe
 * Date: 18-1-25
 * Time: 下午5:49
 */

namespace App\Observers;

use App\Dict;
use App\Log;
use App\Mission;
use App\Staff;
use Carbon\Carbon;

class MissionObserver
{

    public function updating(Mission $mission)
    {
        $origin = Mission::find($mission->id);

        $log = [];
        collect(app(Mission::class)->getFillable())->each(function ($field)use($mission,$origin,$log){
            if ($origin->$field != $mission->$field){

                $dicts = ['post_id' ,'status','arithmetic' ];

                if (in_array($field,$dicts)){
                    $old = Dict::find($origin->$field)->name;
                    $new = Dict::find($mission->$field)->name;
                }else
                    $old = $new = null;
                switch ($field){
                    case 'name':
                        $project = '任务名称';
                        break;
                    case 'post_id':
                        $project = '任务岗位';
                        break;
                    case 'description':
                        $project = '任务描述';
                        break;
                    case 'status':
                        $project = '任务状态';
                        break;
                    case 'start_time':
                        $project = '起始时间';
                        break;
                    case 'end_time':
                        $project = '结束时间';
                        break;
                    case 'complete_time':
                        $project = '实际完成时间';
                        if ($origin->staff_id){
                            $staff = Staff::find($origin->staff_id);
                            $staff->mission_status = Dict::where('code','no_mission')->first()->id;
                            $staff->save();
                        }
                        break;
                    case 'amount':
                        $project = '任务量';
                        break;
                    case 'staff_id':
                        $project = empty($origin->$field) ? '指派' : '改派';


                        if ($origin->$field){
                            //原员工正在进行的任务数量
                            $mission_sum = Mission::where('staff_id',$origin->$field )->whereNotNull('complete_time')->count();
                            if ($mission_sum == 1){
                                $staff = Staff::find($origin->$field);
                                //修改员工的任务状态为无任务
                                $staff->mission_status = Dict::where('code','no_mission')->first()->id;
                                $staff->save();
                            }
                        }
                        $staff = Staff::find($mission->$field);
                        //修改员工的任务状态为任务中
                        $staff->mission_status = Dict::where('code','missioning')->first()->id;
                        $staff->save();
                        break;
                    case 'upper':
                        $project = '任务上限';
                        break;
                    case 'sustain':
                        $project = '持续时间';
                        break;
                    case 'arithmetic':
                        $project = '算法';
                        break;
                }

                $data = [
                    'mission_id' => $mission->id,
                    'project' => $project,
                    'original' => $old ?: $origin->$field,
                    'modification' => $new ?: $mission->$field,
                    'created_at' => Carbon::now()->toDateTimeString()
                ];
                $log [] = $data;
            }

            ! empty($log) && Log::insert($log);
        });

    }
}