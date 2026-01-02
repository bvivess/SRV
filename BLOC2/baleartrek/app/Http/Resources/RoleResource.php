<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\ImageResource;

class RoleResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'identificador' => $this->id,
            'name' => $this->name,
        ];
    }
}
