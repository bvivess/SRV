<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Image extends Model
{

    use HasFactory;

    protected $fillable = [
        'url',
        'comment_id',
    ];

    public function comment()
    {
        return $this->hasOne(Comment::class);
    }
    
}
