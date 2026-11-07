<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Country;
use App\Models\Player;
use App\Models\Referee;

class Person extends Model
{
    function country()
    {
        return $this->belongsTo(Country::class);
    }

    function player()
    {
        return $this->hasOne(Player::class);
    }

    function referee()
    {
        return $this->hasOne(Referee::class);
    }

}
