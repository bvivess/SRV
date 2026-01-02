<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Municipality;

class Island extends Model
{
    public function municipalities()
    {
        return $this->hasMany(Municipality::class);
    }
}
