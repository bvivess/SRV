<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'identificador' => $this->id,
            'comentari' => $this->comment,
            'imatges' => ImageResource::collection($this->whenLoaded('images')),  // al ser una relació 1:N cal fer servir 'ImageResource::collection'
        ];
    }
}


