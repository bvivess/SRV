<?php

namespace App\Models;

use App\Models\Image;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public function images()
    {
        return $this->hasMany(Image::class);
    }
}
