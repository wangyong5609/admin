<?php

namespace App;

use App\Helper\Util;
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
	
	use SoftDeletes,Util;

	protected $dates = ['deleted_at'];
    
	
    protected $table = 'missions';

    protected $fillable = [
        'name','post_id','status','description','start_time','end_time','status_name',
        'complete_time','amount','staff_id','upper','sustain','is_template'
    ];

    protected $appends = [
        'short_desc','priority_name','consuming'
    ];
    public function post()
    {
        return $this->belongsTo(Post::class,'post_id');
    }
    public function priorityDict()
    {
        return $this->belongsTo(Dict::class,'priority');
    }
    public function statusDict()
    {
        return $this->belongsTo(Dict::class,'status');
    }



    /**
     * 已用时间
     * @return float
     */
    public function getConsumingAttribute()
    {
        $sum = MissionSwitch::where('mission_id',$this->id)->whereNotNull('consuming')->sum('consuming');
        $model = MissionSwitch::where('mission_id',$this->id)->whereNull('stop_time')->first();
        if ($model)
            $sum += $this->diffDateOfDays(Carbon::parse($model->start_time),Carbon::now(),$model->mission->staff_id);
        //info($this->diffDateOfDays(Carbon::parse($model->start_time),Carbon::now(),$model->mission->staff_id));
        return $sum;
    }

    public function getShortDescAttribute()
    {
        if (strlen($this->attributes['description']) > 60)
            return str_limit($this->attributes['description'],60);
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

    public function getPriorityNameAttribute()
    {
        return $this->priorityDict->name;
    }
    public function getStatusNameAttribute()
    {
        if ($this->statusDict)
            return $this->statusDict->name;
        return null;
    }

    public function scopeShow($query)
    {
        return $query->where('show',true)->whereNotIn('status',Dict::whereIn('code',['close'])->get()->pluck('id'));
    }

    public function getIsCloseAttribute():bool
    {
        return $this->status == Dict::ofCode('close')->first()->id ? true :false;
    }
}
