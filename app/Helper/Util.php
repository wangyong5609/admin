<?php
/**
 *
 * Created by PhpStorm.
 * User: zhangzhe
 * Date: 18-1-29
 * Time: 下午4:51
 */
namespace App\Helper;

use Illuminate\Database\Eloquent\Builder;

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
}