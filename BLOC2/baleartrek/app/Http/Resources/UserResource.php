<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\MeetingResource;
use App\Http\Resources\CommentResource;
use App\Http\Resources\ImageResource;
use App\Http\Resources\RoleResource;

class UserResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [  
            'identificador' => $this->id,
            'nom' => $this->name,
            'llinatge' => $this->lastname,
            'dni' => $this->dni,
            'email' => $this->email,
            'phone' => $this->phone,
            'role' => $this->role->name,
            'guia' => new MeetingResource($this->whenLoaded('meeting')),
            'meetings' => MeetingResource::collection($this->whenLoaded('meetings')),  // 1:N -> cal tornar una col: collection[comments()]
            'comments' => CommentResource::collection($this->whenLoaded('comments')),   // 1:N -> cal tornar una col: collection[comments()]
        ];
    }
}
