<?php

namespace App;

use App\Enums\CodeTypes;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Staff.
 *
 * @author  The scaffold-interface created at 2018-01-20 09:30:44am
 * @link  https://github.com/amranidev/scaffold-interface
 */
class Staff extends Model
{
	
	use SoftDeletes;

	protected $dates = ['deleted_at'];
    protected $fillable = [
        'name','status','description','phone'
    ];
	
    protected $table = 'staffs';

    protected $appends = [
        'post_names','last_mission_start','last_mission_end','doing_mission','status_name','status_id'
    ];

    public function getPostNamesAttribute()
    {
        return $this->posts()->pluck('name')->toArray();
    }
    public function getStatusNameAttribute()
    {
        $log = $this->workLog()->where('date',Carbon::now()->toDateString())->first();
        if ($log)
            return $log->statusDict->name;
        $log = $this->workLog()->where('date',Carbon::now()->addDay(-1)->toDateString())->first();
        return $log? $log->statusDict->name:null;
    }

    public function getStatusIdAttribute()
    {
        $log = $this->workLog()->where('date',Carbon::now()->toDateString())->first();
        if ($log)
            return $log->statusDict->id;
        return null;
    }
    public function workLog()
    {
        return $this->hasMany(StaffWorkLog::class,'staff_id');
    }

    public function getMissionStatusNameAttribute()
    {
        return $this->missionStatusDict->name;
    }

    public function getLastMissionStartAttribute()
    {
        $doing = Mission::where('status',Dict::ofCode('doing')->first()->id)
            ->where('staff_id',$this->attributes['id'])
            ->first();
        if ($doing)
            return $doing->start_time;
        $mission = Mission::where('staff_id',$this->attributes['id'])->whereNotNull('complete_time')->orderBy('updated_at','desc')->first();

        return empty($mission) ?  '' : $mission->start_time;

    }

    public function getLastMissionEndAttribute()
    {
        $mission = Mission::where('staff_id',$this->attributes['id'])->whereNotNull('complete_time')->orderBy('updated_at','desc')->first();

        return empty($mission) ?  '' : $mission->complete_time;

    }
    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }

    public function user()
    {
        return $this->hasOne(User::class,'staff_id');
    }
    public function missionStatusDict()
    {
        return $this->belongsTo(Dict::class,'mission_status');
    }

    public function missions()
    {
        return $this->hasMany(Mission::class,'staff_id');
    }

    public function getDoingMissionAttribute()
    {
        return $this->missions()->where('status',Dict::ofCode('doing')->first()->id)->first();
    }
}
