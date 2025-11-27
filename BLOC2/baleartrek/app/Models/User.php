<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Role;
use App\Models\Comment;
use App\Models\Meeting;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
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
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function name(): Attribute
    {
        return Attribute::make(
            get: function ($value) { return ucfirst($value); }, // Torna el name amb la primera en maiúscules
            set: function ($value) { return strtoupper($value); }  // Guarda el name en minúscules
        );
    }

    public function lastName(): Attribute
    {
        return Attribute::make(
            get: function ($value) { return ucfirst($value); }, // Torna el name amb la primera en maiúscules
            set: function ($value) { return strtoupper($value); }  // Guarda el name en minúscules
        );
    }

    public function eMail(): Attribute
    {
        return Attribute::make(
            set: function ($value) { return strtolower($value); }  // Guarda el name en minúscules
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

    public function role()
    {
        return $this->hasOne(Role::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function meetings()
    {
      return $this->belongsToMany(Meeting::class);
    }
}
