<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
// use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
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

    protected $fillable = [
        'name',
        'lastname',
        'dni',
        'email',
        'phone',
        'password',
        'role_id',
    ];

    //protected $guarded = [
    //    'id'
    //];

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

    public function lastname(): Attribute
    {
        return Attribute::make(
            get: function ($value) { return ucfirst($value); }, // Torna el name amb la primera en maiúscules
            set: function ($value) { return strtoupper($value); }  // Guarda el name en minúscules
        );
    }

    public function email(): Attribute
    {
        return Attribute::make(
            set: function ($value) { return strtolower($value); }  // Guarda el name en minúscules
        );
    }

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function meeting()
    {
      return $this->hasOne(Meeting::class);
    }

    public function meetings()
    {
      return $this->belongsToMany(Meeting::class);
    }

    // Mètodes per comprovar rols
    public function isAdmin(): bool
    {
        return $this->role_id === Role::where('name', 'admaain')->first()?->id;
    }

/*
    public function getRouteKeyName()
    {
        return 'email'; // cerca per 'email' (UK)
    }
*/

}
