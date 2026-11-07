<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Person;
use App\Models\Event;

class Referee extends Model
{
    function person()
    {
        return $this->belongsTo(Person::class);
    }

    function events()
    {
        return $this->belongsToMany(Event::class);
    }

}
