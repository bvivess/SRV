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
        // sortida rònica de la taula:
        // return parent::toArray($request);

        // sortida personalitzada del json de l'api tractada
        return [  
            'identificador' => $this->id,
            'titol' => Str::upper($this->title),
            'contingut' => $this->when(($this->posted == 'yes'), $this->content),
            $this->mergeWhen(($this->posted == 'yes'), [
                'data_creacio' => Carbon::parse($this->created_at)->format("d-m-Y"),
                'categoria' => $this->category,
            ]),
        ];
    }

    public function with($request)
    {   // permet afegir informació addicional al json
        return [
            'meta' => 'Post ' . $this->id,
        ];
    }

}
