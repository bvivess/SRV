<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Comment;

class Image extends Model
{
    function comment()
    {
        return $this->belongsTo(Comment::class);
    }

}
