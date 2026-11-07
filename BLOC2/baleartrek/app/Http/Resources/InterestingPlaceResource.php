<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\ImageResource;

class InterestingPlaceResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'identificador' => $this->id,
            'name' => $this->name,
            'gps_location' => $this->gps,
            'place_type' => $this->placeType->name,
            'ordre' => $this->pivot->order
        ];
    }
}
