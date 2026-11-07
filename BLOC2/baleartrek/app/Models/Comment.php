<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Meeting;
use App\Models\Image;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'comment',
        'score',
        'user_id',
        'meeting_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function meeting()
    {
        return $this->belongsTo(Meeting::class);
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }
}
