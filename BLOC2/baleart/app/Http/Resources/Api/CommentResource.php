<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use App\Http\Resources\Api\ImageResource;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            $this->mergeWhen(($this->status == 'y'), [  // ja venen filtrades des del Model
                'comentari' => $this->comment,
                'puntuacio' => $this->score,
                'imatges' => ImageResource::collection($this->whenLoaded('images')),
            ]),
        ];
    }
}
