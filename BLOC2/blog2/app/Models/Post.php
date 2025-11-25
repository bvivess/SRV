<?php

namespace App\Models;

use App\Models\Tag;
use App\Models\User;
use App\Models\Comment;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory, Notifiable;

    // protected $table = 'NomTaula';  // Si la taula i el model no segueixen la convenció de Laravel
    // protected $primaryKey = 'id';
    
    // Atributs que es poden emplenar de manera automàtica: associat al mètode 'Post::create()'
    protected $fillable = [ 
        //'title',
        'content',
        'user_id',
        'category_id',
    ];

    protected $hidden = [
        'url_clean',
    ];

    // Atributs que no es poden emplenar de manera automàtica
    protected $guarded = [
        'id'
    ];

    // Mutador
    protected function title(): Attribute
    {
        return Attribute::make(
            get: function ($value) { return ucfirst($value);}, // Torna el títol amb la primera en maiúscules
            set: function ($value) { return strtoupper($value); }  // Guarda el títol en minúscules
        );
    }

    protected function urlClean(): Attribute
    {
        return Attribute::make(
            get: function ($value) { return ucwords(str_replace('_', ' ', $value));}, // Torna l'url neta amb majúscules a l'inici de cada paraula i espais
            set: function ($value) { return strtolower(str_replace(' ', '_', $value)); }  // Guarda l'url neta en minúscules i guions baixos
        );
    }

    // Relacions entre taules: 
    public function category()
    {
      return $this->belongsTo(Category::class);  // N:1
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class)->withPivot('created_at', 'updated_at');  // M:N
    }

    public function user() 
    {
        return $this->belongsTo(User::class);   // N:1
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);  // 1:N
    }
}