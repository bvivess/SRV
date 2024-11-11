<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Resources\PostResource;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'identificador' => $this->id,
            'nom' => $this->name,
            'email' => $this->email,
            'role' => $this->role,
            'creacio' => Carbon::parse($this->created_at)->format("d-m-Y h:m:s"),
            'posts' => PostResource::collection($this->whenLoaded('posts')), // utilitza 'PostResource' per a cada post
            //'images' => ImageResource::collection($this->whenLoaded('images')), // utilitza 'PostResource' per a cada post
        ];
    }
}
