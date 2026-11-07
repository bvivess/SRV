<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Country;


class Province extends Model
{
    function country()
    {
        return $this->belongsTo(Country::class);
    }

    function locations()
    {
        return $this->hasMany(Location::class);
    }
}
