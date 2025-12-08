<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\InterestingPlace;

class PlaceType extends Model
{
    public function InterestingPlaces()
    {
        return $this->hasMany(InterestingPlace::class);
    }

}
