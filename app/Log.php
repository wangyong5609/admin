<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Log.
 *
 * @author  The scaffold-interface created at 2018-01-20 09:35:21am
 * @link  https://github.com/amranidev/scaffold-interface
 */
class Log extends Model
{
	
	use SoftDeletes;

	protected $dates = ['deleted_at'];
    
	
    protected $table = 'logs';

    public function mission()
    {
        return $this->belongsTo(Mission::class,'mission_id');
	}

    public function getMissionNameAttribute()
    {
        $tmp = $this->mission;
        if($tmp){
            return $this->mission->name;
        }
        return "未找到任务";
	}

    public function getMissionDescAttribute()
    {
        $tmp = $this->mission;
        if($tmp){
            return $tmp->description;
        }
        return "未找到任务";
    }

    public function getOriginalAttribute()
    {
        if ($this->attributes['project'] == '改派')
            return Staff::find($this->attributes['original'])->name;
        return $this->attributes['original'];
    }

    public function getModificationAttribute()
    {
        if ($this->attributes['project'] == '改派')
            return Staff::find($this->attributes['modification'])->name;
        return $this->attributes['modification'];
    }
}
