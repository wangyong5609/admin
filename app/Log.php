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

	
}
