<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Person;
use App\Models\Team;
use App\Models\Event;

class Player extends Model
{
    function person()
    {
        return $this->belongsTo(Person::class);
    }

    function team()
    {
        return $this->belongsTo(Team::class);
    }

    function events()
    {
        return $this->belongsToMany(Event::class);
    }

}
