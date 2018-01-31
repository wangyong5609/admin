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

class StaffObserver
{
    public function creating(Staff $staff)
    {
        $staff->mission_status = Dict::where('code','no_mission')->first()->id;
    }
}