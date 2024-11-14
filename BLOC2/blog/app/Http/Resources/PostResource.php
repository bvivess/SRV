<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
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
            'categoria' => $this->category->title,
            //'contingut' => $this->when(($this->posted == 'yes'), $this->content),
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
        ];
    }

    public function with($request)
    {   // permet afegir informació addicional al JSON al 'PostController' amb '->additional(['meta' => ...')
        return [
            'meta' => 'Post ' . $this->id,
        ];
    }

}
