<?php

namespace App;

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
        'complete_time','amount','staff_id','upper'
    ];

    public function post()
    {
        return $this->belongsTo(Dict::class,'post_id');
    }

    public function statusDict()
    {
        return $this->belongsTo(Dict::class,'status');
    }
}
