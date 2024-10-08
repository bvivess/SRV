<?php

namespace App\Models;

use App\Models\User;
use App\Models\Comment;
use App\Models\Category;
use App\Models\PostImage;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    // protected $table = 'NomTaula';  // Si la taula i el model no segueixen la convenció de Laravel
    // protected $primaryKey = 'id';
    
    // Atributs que es poden emplenar de manera automàtica: associat al mètode 'Post::create()'
    protected $fillable = [ 
        'title',
        'url_clean',
        'content',
        'user_id',
    ];

    // Atributs que no es poden emplenar de manera automàtica
    protected $guarded = [
        'id'
    ];

    // Relacions entre taules
    public function category()
    {
      return $this->belongsTo(Category::class);
    }

    public function user()
    {
      return $this->belongsTo(User::class);
    }

    public function image(){
        return $this->hasOne(PostImage::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    // Exemple d'ús: per emprar amb ->with()
    public function commentsFamosos()
    {
        return $this->hasMany(Comment::class)->wherein('user_id', [4, 8 ,9]);  // per exemple
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

}