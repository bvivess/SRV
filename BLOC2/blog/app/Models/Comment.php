<?php

namespace App\Models;

use App\Models\Post;
use App\Models\Image;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comment extends Model
{
    use HasFactory;

    protected $table = 'post_user';  // Si la taula i el model no segueixen la convenció de Laravel

    public function images()
    {
        return $this->hasMany(Image::class);  // 1:N
    }

    public function comments()
    {
        return $this->belongsTo(Post::class);
    }
}
