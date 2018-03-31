<?php

namespace App\Enums;


use MyCLabs\Enum\Enum;

class DictCodes extends Enum
{
    /**
     * 工作状态
     */
    const STAFF_STATUS_WORk = 'work';
    const STAFF_STATUS_BUSINESS = 'business';
    const STAFF_STATUS_LEAVE = 'leave';

    /**
     * 任务状态
     */
    const MISSION_STATUS_NEW = 'new';
    const MISSION_STATUS_DOING = 'doing';
    const MISSION_STATUS_WAIT = 'wait';
    const MISSION_STATUS_COMPLETE = 'complete';
    const MISSION_STATUS_CLOSE = 'close';


    /**
     * 员工任务状态
     */
    const STAFF_MISSION_STATUS_NO_MISSION = 'no_mission';
    const STAFF_MISSION_STATUS_MISSIONING = 'missioning';

    /**
     * 任务优先级
     */
    const MISSION_PRIORITY_COMMON = 'common';
    const MISSION_PRIORITY_IMPORTANCE = 'importance';
    const MISSION_PRIORITY_URGENCY = 'urgency';
}