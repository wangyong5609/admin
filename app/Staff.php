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
    
	
    protected $table = 'staffs';

    public function postDict()
    {
        return $this->belongsTo(Dict::class,'post');
	}

    public function statusDict()
    {
        return $this->belongsTo(Dict::class,'status');
    }

}
