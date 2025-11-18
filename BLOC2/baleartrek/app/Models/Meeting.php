<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Comment;

class Meeting extends Model
{
    public function user()
    {
      return $this->belongsTo(User::class);
    }

    public function comments()
    {
      return $this->hasMany(Comment::class);
    }

    public function users()
    {
      return $this->belongsToMany(User::class);
    }
}
