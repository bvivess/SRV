<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Meeting;
use App\Models\Municipality;
use App\Models\InterestingPlace;

class Trek extends Model
{
    protected $fillable = [
        'regNumber',
        'name',
        'municipality_id',
    ];

    public function meetings()
    {
        return $this->hasMany(Meeting::class);
    }

    public function municipality()
    {
        return $this->belongsTo(Municipality::class);
    }

    public function interestingPlaces()
    {
        return $this->belongsToMany(InterestingPlace::class)->withPivot('order')->withTimestamps();
    }

}
