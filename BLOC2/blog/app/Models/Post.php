<?php

namespace App\Models;

use App\Models\Tag;
use App\Models\User;
use App\Models\Image;
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
        'title',
        'url_clean',
        'content',
        'user_id',
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
            set: function ($value) { return strtolower($value); }  // Guarda el títol en minúscules
        );
    }

    // Relacions entre taules: 
    public function category()
    {
      return $this->belongsTo(Category::class);  // N:1
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);  // M:N
    }

    public function users()
    {
        return $this->belongsToMany(User::class)->withPivot('comment');  // M:N (amb atributs)
    }
}