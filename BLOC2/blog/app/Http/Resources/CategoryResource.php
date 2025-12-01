<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;
use Carbon\Carbon;

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
            'nom' => $this->title,
            'url' => Str::upper($this->url_clean),
            'creacio' => Carbon::parse($this->created_at)->format("d-m-Y h:m:s"),
            'modificacio' => Carbon::parse($this->updated_at)->format("d-m-Y h:m:s"),
            'posts' => PostResource::collection($this->whenLoaded('posts')),
        ];
    }
}
