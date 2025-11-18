<?php

namespace App\Http\Resources\Api;

use App\Models\Zone;
use App\Models\Island;
use App\Models\Municipality;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AddressResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [  
            'carrer' => $this->name,
            'zona' => Zone::find($this->zone_id)->name,
            'municipi' => Municipality::find($this->municipality_id)->name,
            'illa' => Island::find(Municipality::find($this->municipality_id)->island_id)->name,
        ];
    }
}
