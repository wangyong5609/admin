<?php
/**
 * Created by PhpStorm.
 * User: zhangzhe
 * Date: 18-1-25
 * Time: 下午5:49
 */

namespace App\Observers;

use App\Dict;
use App\Staff;
use App\User;

class StaffObserver
{
    public function creating(Staff $staff)
    {
        $staff->mission_status = Dict::where('code','no_mission')->first()->id;

    }

    public function created(Staff $staff)
    {
        User::create([
            'name' => $staff->name,
            'email' => $staff->name,
            'password' => bcrypt('123456'),
            'staff_id' =>$staff->id
        ]);
    }

    public function updated(Staff $staff)
    {
        $staff->user()->update([
            'name' => $staff->name
        ]);
    }
}