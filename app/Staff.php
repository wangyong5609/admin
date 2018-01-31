<?php

namespace App;

use App\Enums\CodeTypes;
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
        'name','post','status','description'
    ];
	
    protected $table = 'staffs';

    protected $appends = [
        'post_name','status_name'
    ];

    public function getPostNameAttribute()
    {
        return $this->postDict->name;
    }
    public function getStatusNameAttribute()
    {
        return $this->statusDict->name;
    }

    public function postDict()
    {
        return $this->belongsTo(Dict::class,'post');
	}

    public function statusDict()
    {
        return $this->belongsTo(Dict::class,'status');
    }
    public function missionStatusDict()
    {
        return $this->belongsTo(Dict::class,'mission_status');
    }
}
