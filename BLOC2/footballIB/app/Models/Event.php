<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Team;
use App\Models\Player;
use App\Models\Referee;
use App\Models\Comment;
use App\Models\MatchDay;

class Event extends Model
{
    function homeTeam()
    {
        return $this->belongsTo(Team::class, 'team_id_home');
    }

    function awayTeam()
    {
        return $this->belongsTo(Team::class, 'team_id_away');
    }

    function players()
    {
        return $this->belongsToMany(Player::class);
    }

    function referees()
    {
        return $this->belongsToMany(Referee::class);
    }
    
    function comments()
    {
        return $this->hasMany(Comment::class);
    }

    function matchDay()
    {
        return $this->belongsTo(MatchDay::class);
    }
}
