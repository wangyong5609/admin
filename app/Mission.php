<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Mission.
 *
 * @author  The scaffold-interface created at 2018-01-20 09:33:27am
 * @link  https://github.com/amranidev/scaffold-interface
 */
class Mission extends Model
{
	
	use SoftDeletes;

	protected $dates = ['deleted_at'];
    
	
    protected $table = 'missions';

    protected $fillable = [
        'name','post_id','status','description','start_time','end_time',
        'complete_time','amount','staff_id','upper','arithmetic','sustain'
    ];

    protected $appends = [
        'short_desc'
    ];
    public function post()
    {
        return $this->belongsTo(Dict::class,'post_id');
    }

    public function statusDict()
    {
        return $this->belongsTo(Dict::class,'status');
    }

    public function arithmeticDict()
    {
        return $this->belongsTo(Dict::class,'arithmetic');
    }

    /**
     * 任务周期
     * @return float
     */
    public function getLifeAttribute()
    {
        $date = floor((strtotime($this->attributes['end_time'])-strtotime($this->attributes['start_time']))/86400);
        return $date;
    }

    /**
     * 已用时间
     * @return float
     */
    public function getConsumingAttribute()
    {
        $date = floor((Carbon::now()->timestamp - strtotime($this->attributes['start_time']))/86400);
        return $date;
    }
    
    public function getArithmeticNameAttribute()
    {
        return $this->arithmeticDict->name;
    }
    public function getShortDescAttribute()
    {
        if (strlen($this->attributes['description']) > 60)
            return substr($this->attributes['description'],0,60).'..';
        return $this->attributes['description'];
    }
    public function getCompleteTimeAttribute()
    {
        if ( empty($this->attributes['complete_time']) )
            return '未完成';
        return $this->attributes['complete_time'];
    }

    public function staff()
    {
        return $this->belongsTo(Staff::class,'staff_id');
    }

    public function getStaffNameAttribute()
    {
        if (empty($this->staff))
            return '未分配';
        return $this->staff->name;
    }

    public function getPostNameAttribute()
    {
        return $this->post->name;
    }
    public function getStatusNameAttribute()
    {
        return $this->statusDict->name;
    }
}
