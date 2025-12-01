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
            'titol' => Str::upper($this->title),
            'url' => $this->url_clean,  // es decideix incloure manualment aquest atribut
            'categoria' => $this->category->title,  // funció 'category()'
            'usuari' => $this->user->name, // funció 'user()'
            'contingut' => $this->when(($this->posted == 'yes'), $this->content),
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            $this->mergeWhen(($this->posted == 'yes'),  // Condició d'inclusió
                [ 'categoria' => new CategoryResource($this->whenLoaded('category')),  // N:1 -> cal tornar un obj: 'new category()'
                  'usuari' => new UserResource($this->whenLoaded('user')),  // N:1 -> -> cal tornar un obj: 'new user()'
                  'comentaris' => CommentResource::collection($this->whenLoaded('comments')),  // 1:N -> cal tornar una col: collection[comments()]
                ])
        ];

    }

}
