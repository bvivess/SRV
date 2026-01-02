<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;
use App\Http\Resources\MeetingResource;
use App\Http\Resources\InterestingPlaceResource;


class TrekResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [  
            'identificador' => $this->id,
            'registre' => $this->regNumber,
            'nom' => $this->name,
            'municipi' => $this->municipality->name,
            'llocsInteressants' => InterestingPlaceResource::collection($this->whenLoaded('interestingPlaces')),
            'reunions' => MeetingResource::collection($this->whenLoaded('meetings')),
        ];
    }
}
