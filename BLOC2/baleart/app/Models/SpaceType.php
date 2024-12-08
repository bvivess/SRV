<?php

namespace App\Models;

use App\Models\Space;
use Illuminate\Database\Eloquent\Model;

class SpaceType extends Model
{
    public function spaces()
    {
        return $this->hasMany(Space::class);
    }
}
