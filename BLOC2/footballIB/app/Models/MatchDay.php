<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Event;

class MatchDay extends Model
{
    function events()
    {
        return $this->hasMany(Event::class);
    }

}
