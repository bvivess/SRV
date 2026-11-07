<?php

namespace App\Models;

use App\Models\User;
use App\Models\Image;
use App\Models\Space;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'comment',
        'score',
        'status',
        'user_id',
        'space_id',
    ];

    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function space()
    {
        return $this->hasOne(Space::class);
    }

}
