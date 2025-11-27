<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Comment;

class Image extends Model
{
    use HasFactory;
    
    public function comment()
    {
        return $this->belongsTo(Comment::class);
    }
}
