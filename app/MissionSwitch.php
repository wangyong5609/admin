<?php

namespace App;

use App\Helper\Util;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class MissionSwitch extends Model
{
    use Util;
    protected $table = 'mission_switches';

    public $timestamps = false;
    public function mission()
    {
        return $this->belongsTo(Mission::class,'mission_id');
    }

    public function missionOn($mission_id)
    {
           $this->insert([
               'mission_id' => $mission_id,
               'start_time' => Carbon::now()->toDateTimeString()
           ]);
    }

    public function missionOff($mission_id)
    {
        $model = $this->where('mission_id',$mission_id)->whereNull('stop_time')->first();
        $model->stop_time = Carbon::now()->toDateTimeString();
        $model->consuming = $this->diffDateOfDays(Carbon::parse($model->start_time),Carbon::now(),$model->mission->staff_id);
        $model->save();
    }
}
