<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Role;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;                                 // AFEGIR IMPORTANT !!!!!

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;                     // AFEGIR IMPORTANT !!!

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'lastname',
        'email',
        'password',
        'role_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function name(): Attribute
    {
        return Attribute::make(
            get: function ($value) { return ucfirst($value); }, // Torna el títol amb la primera en maiúscules
            set: function ($value) { return strtoupper($value); }  // Guarda el títol en minúscules
        );
    }

    public function lastname(): Attribute
    {
        return Attribute::make(
            get: function ($value) { return ucfirst($value); }, // Torna el títol amb la primera en maiúscules
            set: function ($value) { return strtoupper($value); }  // Guarda el títol en minúscules
        );
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Relacions entre taules:
    public function comments()
    {
        return $this->hasMany(Comment::class);  // 1:N
    }

    public function posts()
    {
        return $this->hasMany(Post::class);  // 1:N
    }

    public function role()
    {
        return $this->belongsTo(Role::class);  // N:1
    }

    // Mètodes per comprovar rols
    public function isAdmin(): bool
    {
        $roleAdmin = Role::where('name', 'admin')->first()->id;
        return $this->role_id == $roleAdmin;
    }

}
