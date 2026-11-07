<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Player;
use App\Models\Event;
use App\Models\Stadium;

class Team extends Model
{
    function players()
    {
        return $this->hasMany(Player::class);
    }

    function homeEvents()
    {
        return $this->hasMany(Event::class, 'home_team_id');
    }

    function awayEvents()
    {
        return $this->hasMany(Event::class, 'away_team_id');
    }

    function stadium()
    {
        return $this->belongsTo(Stadium::class);
    }
}
