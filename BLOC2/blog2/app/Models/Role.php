<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Role extends Model
{  
<<<<<<< HEAD
    protected $fillable = [
        'name',
    ];

    protected $hidden = [
        'id',
    ];

=======
>>>>>>> cc6c34e27980f064f485069f49a0f67c773daef4
    public function users()
    {
      return $this->hasMany(User::class);
    }
}
