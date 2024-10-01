<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
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
            'url_clean' => Str::upper($this->url_clean),
            'data_creacio' => Carbon::parse($this->created_at)->format("d-m-Y"),
        ];
    }

    public function with($request)
    {
        return [
            'meta' => 'Categoria ' . $this->id ,
        ];
    }

}
