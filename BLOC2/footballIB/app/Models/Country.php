<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Person;
use App\Models\Province;

class Country extends Model
{
    function people()
    {
        return $this->hasMany(Person::class);
    }

    function provinces()
    {
        return $this->hasMany(Province::class);
    }

}
