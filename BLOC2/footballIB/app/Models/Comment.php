<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Event;
use App\Models\User;
use App\Models\Image;

class Comment extends Model
{
    function event() {
        return $this->belongsTo(Event::class);
    }

    function user() {
        return $this->belongsTo(User::class);
    }

    function images() {
        return $this->hasMany(Image::class);
    }

}
