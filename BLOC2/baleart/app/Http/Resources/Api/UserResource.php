<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use App\Http\Resources\Api\SpaceResource;
use App\Http\Resources\Api\CommentResource;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $isNested = str_contains($request->route()->getActionName(), 'UserController@show');

        return [  
            'nom' => $this->lastname . ", " . $this->name,
            'telefon' => $this->phone,
            'email' => $this->email,
            $this->mergeWhen($isNested, [
                'gestionant' => SpaceResource::collection($this->whenLoaded('spaces')),
                'comentaris' => CommentResource::collection($this->whenLoaded('comments')),
            ]),
        ];
    }
}