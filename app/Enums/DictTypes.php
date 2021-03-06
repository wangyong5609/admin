<?php

namespace App\Enums;


use MyCLabs\Enum\Enum;

class DictTypes extends Enum
{
    /**
     * 员工岗位
     */
    const STAFF_POST = 'type_staff_post';

    /**
     * 员工状态
     */
    const STAFF_STATUS = 'type_staff_status';

    /**
     * 任务状态
     */
    const MISSION_STATUS = 'type_mission_status';

    /**
     * 时间算法
     */
    const MISSION_ARITHMETIC = 'type_mission_arithmetic';

    /**
     * 员工任务状态
     */
    const STAFF_MISSION_STATUS = 'type_staff_mission_status';

    /**
     * 任务优先级
     */
    const MISSION_PRIORITY = 'type_mission_priority';
}