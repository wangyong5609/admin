<?php
/**
 *
 * Created by PhpStorm.
 * User: zhangzhe
 * Date: 18-1-29
 * Time: 下午4:51
 */
namespace App\Helper;

use App\Dict;
use App\Mission;
use App\StaffWorkLog;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

trait Util
{

    public  function applyFilters(Builder $query): Builder
    {
        $data = \Request::all();

        foreach ($data as $key => $value) {
            if (in_array($key,array_merge($query->getModel()->getFillable(),$query->getModel()->getHidden()))) {
                $query->where(function ($builder) use ($key, $value) {
                    $builder->where($key, $value);
                    $builder->orWhere( $key, 'like', '%' . $value . '%');
                });
            }
        }

        return $query;
    }

    public function pageNumber()
    {
        return 15;
    }

    public static function getSeriesNumber($number, $length = 4, $padding = '0')
    {
        $format = '%\'' . $padding . $length . 'd';

        return sprintf($format, intval($number));
    }

    public function getMissionName($name)
    {
        if (Str::contains($name,'-'));
            $name = explode('-',$name)[0];
        return $name.'-'.self::getSeriesNumber(Mission::where('is_template',false)->count()+1);
    }

    public function diffDateOfDays(Carbon $start,Carbon $end,$staff_id)
    {
        if ($end->lte($start))
            return 0;
        $count = 0;
        do{
            $flag = StaffWorkLog::query()->where('staff_id',$staff_id)
                ->where('date',$start->toDateString())
                ->where('status',Dict::ofCode('work')->first()->id)
                ->where('disabled',false)
                ->exists();
            if ($flag)
                $count++;
            $start = $start->addDay(1);
            //info($start->toDateString().$flag?'上班':'不上班');
        }
        while($end->gt($start));
        $hours=floor((strtotime($start)-strtotime($end))%86400/3600);
        return $count-number_format($hours/24,2);
    }
}