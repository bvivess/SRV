<?php

namespace App\Models;

use App\Models\Zone;
use App\Models\Municipality;
use App\Models\Space;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    public function space()
    {
        return $this->hasOne(Space::class);
    }

    public function municipality()
    {
        return $this->belongsTo(Municipality::class);
    }

    public function zone()
    {
        return $this->belongsTo(Zone::class);
    }
}
