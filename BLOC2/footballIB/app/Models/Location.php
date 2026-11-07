<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Province;
use App\Models\Stadium;

class Location extends Model
{
    function province()
    {
        return $this->belongsTo(Province::class);
    }

    function stadiums()
    {
        return $this->hasMany(Stadium::class);
    }
}
