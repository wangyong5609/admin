<?php

namespace App;

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
}
