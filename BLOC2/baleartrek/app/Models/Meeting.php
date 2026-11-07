<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Comment;

class Meeting extends Model
{
    protected $fillable = [
      'user_id',
      'trek_id',
      'day',
      'time',
      'appDateIni',
      'appDateEnd',
    ];

    public function comments()
    {
      return $this->hasMany(Comment::class);
    }

    public function user()
    {
      return $this->belongsTo(User::class);
    }

    public function users()
    {
      return $this->belongsToMany(User::class);
    }

    public function calculaMitjana()
    {
      return $this->hasMany(Comment::class)->where('status', 'y')->avg('score');
    }
}
