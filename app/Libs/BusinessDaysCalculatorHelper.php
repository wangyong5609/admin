<?php
namespace App\Libs;
use DateTime;
use Log;
/**
 * Class BusinessDaysCalculatorHelper
 * @package common\support
 * $holidays = ["2017-01-27", "2017-01-28", "2017-01-29", "2017-01-30", "2017-01-31", "2017-02-01", "2017-02-02"];
 * $specialBusinessDay = ["2017-01-22"];//因法定节假日调休而上班的周末，这种情况也算工作日.因为这种情况少，可以通过手动配置
 * $calculator = new BusinessDaysCalculatorHelper(
 * new DateTime(), //当前时间
 * $holidays,
 * [BusinessDaysCalculatorHelper::SATURDAY, BusinessDaysCalculatorHelper::SUNDAY],
 * $specialBusinessDay
 * );
 * $calculator->addBusinessDays(2); // 2个工作日后的时间
 * $afterBusinessDay = $calculator->getDate();
 * echo $afterBusinessDay;
 */
class BusinessDaysCalculatorHelper
{
    const MONDAY = 1;
    const TUESDAY = 2;
    const WEDNESDAY = 3;
    const THURSDAY = 4;
    const FRIDAY = 5;
    const SATURDAY = 6;
    const SUNDAY = 0;

    private $nonBusinessDays=[6,0];

    public function __construct()
    {
    }
    private function isBusinessDay($date)
    {
        if (in_array((int)Date("w",strtotime($date)), $this->nonBusinessDays)) {

            return false; //当前日期是周末
        }
        return true;
    }

    public function calcBusinessDay($start_day_str,$days)
    {
        $start_day = $start_day_str;
        $i = 0;
        $day=$start_day;
        do {
            if($i>=$days){
                break;
            }
            $day = Date("Y-m-d H:i:s",strtotime('+1 days', strtotime($day)));
            if($this->isBusinessDay($day)){
                $i++;
            }
        }while($i<100);
        return Date("Y-m-d H:i:s",strtotime($day));
    }


}