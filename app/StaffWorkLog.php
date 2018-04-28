<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class StaffWorkLog extends Model
{
    public $timestamps = false;
    protected $table = 'work_logs';
    protected $fillable = ['staff_id','status','date','disabled'];

    public function statusDict()
    {
        return $this->belongsTo(Dict::class,'status');
    }

    public function todayStatus()
    {
        return $this->where('date',Carbon::now()->toDateString())->exists()?
            '<span>已保存今日状态</span>':
            '<span style="color: #f00;">未保存今日状态</span>';
    }
}
