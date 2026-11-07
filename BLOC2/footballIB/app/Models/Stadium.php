<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Location;
use App\Models\Team;

class Stadium extends Model
{
    function location()
    {
        return $this->belongsTo(Location::class);
    }

    function teams()
    {
        return $this->hasMany(Team::class);
    }

}
