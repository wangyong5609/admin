<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Mission_template.
 *
 * @author  The scaffold-interface created at 2018-01-20 09:34:32am
 * @link  https://github.com/amranidev/scaffold-interface
 */
class Mission_template extends Model
{
	
	use SoftDeletes;

	protected $dates = ['deleted_at'];
    
	
    protected $table = 'mission_templates';

    protected $appends= [
        'post_name'
    ];
    public function post()
    {
        return $this->belongsTo(Dict::class,'post_id');
    }
    public function getPostNameAttribute()
    {
        return $this->post->name;
	}
}
