<?php

namespace App;

use App\Enums\CodeTypes;
use Illuminate\Database\Eloquent\Model;

class Dict extends Model
{
    protected $table = 'dicts';

    public function scopeOfCode($query, $code)
    {
        return $query->where('code', $code);
    }

    public function scopeOfType($query, $type)
    {
        return $query->where('type', $type);
    }
}
