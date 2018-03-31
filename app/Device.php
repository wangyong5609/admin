<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    protected $table = 'devices';

    public $timestamps = false;
    protected $fillable = [
        'name','amount'
    ];
}
