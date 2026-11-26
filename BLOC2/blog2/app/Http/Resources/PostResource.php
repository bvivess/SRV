<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\UserResource;
use App\Http\Resources\CommentResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);  // sortida rònica de la taula:
        // sortida personalitzada del JSON de l'API tractada:
        return [
            'identificador' => $this->id,
            'titol' => $this->title,
            'url' => $this->url_clean,  // S'inclou manualment aquest atribut
            'contingut' => $this->when($this->posted == 'yes', $this->content),
            'user' => $this->when($this->user, $this->user->name . ' ' . $this->user->lastname ),  // Nom i cognoms de l'usuari
                'email' => $this->user->email,
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),

            $this->mergeWhen($this->posted == 'yes', [
                'categoria' => new CategoryResource($this->whenLoaded('category')),  // N:1
                'usuari' => new UserResource($this->whenLoaded('user')),             // N:1
                'comentaris' => CommentResource::collection($this->whenLoaded('comments')                                    // 1:N
                ),
            ]),
        ];
    }

}

