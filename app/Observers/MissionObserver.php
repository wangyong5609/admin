<?php
/**
 * Created by PhpStorm.
 * User: zhangzhe
 * Date: 18-1-25
 * Time: 下午5:49
 */

class MissionObserver
{

    public function creating(\App\Mission $mission)
    {
            $mission->status = \App\Dict::where('name','新建')->first()->id;
    }
    public function saving(\App\Mission $mission)
    {
        $mission->status = \App\Dict::where('name','新建')->first()->id;
    }
}