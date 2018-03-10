<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //
    public function staffs()
    {
        return $this->belongsToMany(Staff::class);
    }
}
