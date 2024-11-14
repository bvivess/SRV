<?php

namespace App\Models;

use App\Models\Post;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Image extends Model
{
    use HasFactory;

    // Relacions entre taules:
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
    
}
