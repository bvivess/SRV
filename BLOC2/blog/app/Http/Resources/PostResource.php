<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use App\Http\Resources\ImageResource;
use App\Http\Resources\CategoryResource;
use Illuminate\Http\Resources\Json\JsonResource;

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
            'categoria' => $this->category->title,  // al ser una relació 1:1, es pot fer servir la funció 'category i per tant no cal fer servir 'CategoryResource()'
            'usuari' => $this->user->name,  // al ser una relació 1:1, es pot fer servir la funció 'user' i per tant no cal fer servir 'UserResource()'
            //'contingut' => $this->when(($this->posted == 'yes'), $this->content),
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            $this->mergeWhen(($this->posted == 'yes'), [
                'category' => new CategoryResource($this->whenLoaded('category')),  // al ser una relació 1:1 cal fer 'new' i no cal fer servir 'CategoryResource::collection'
                'usuari' => new UserResource($this->whenLoaded('user')), // al ser una relació 1:1 cal fer 'new' i no cal fer servir 'UserResource::collection'
                'comentaris' => CommentResource::collection($this->whenLoaded('comments')),  // al ser una relació 1:N cal fer servir 'CommentResource::collection'
            ])
        ];
    }

    public function with($request)
    {   // permet afegir informació addicional al JSON al 'PostController' amb '->additional(['meta' => ...')
        return [
            'meta' => 'Post ' . $this->id,
        ];
    }

}

/* CÀRREGA DE LES RELACIONS 1:1 I 1:N TOT I NO VENIR EN EL '$request' AMB 'with()' O 'load()':
$this->mergeWhen(($this->posted == 'yes'), [
    'creacio' => Carbon::parse($this->created_at)->format("d-m-Y h:m:s"),
    'comentaris' => $this->users->map(function ($comment) {
        return [
            'comentari' => $comment->pivot->comment,
            'creacio' => Carbon::parse($comment->created_at)->format("d-m-Y h:m:s"),
        ];
    }),
    'imatges' => $this->images->map(function ($image) {
        return [
            'url' => $image->name,
            'creacio' => Carbon::parse($image->created_at)->format("d-m-Y h:m:s"),
        ];
    }),
]),

*/