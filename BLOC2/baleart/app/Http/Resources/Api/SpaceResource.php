<?php

namespace App\Http\Resources\Api;

use App\Models\SpaceType;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Resources\Api\AddressResource;
use Illuminate\Http\Resources\Json\JsonResource;

class SpaceResource extends JsonResource
{
    public function toArray(Request $request): array
    {           
        $isNested = str_contains($request->route()->getActionName(), 'SpaceController@');

        return [  
            'identificador' => $this->id,
            'nom' => Str::upper($this->name),
            'registre' => $this->regNumber, 
            'observacions_CA' => $this->observation_CA, 
            'observacions_ES' => $this->observation_ES, 
            'observacions_EN' => $this->observation_EN, 
            'gestor/a' => new UserResource($this->whenLoaded('user')),
            'tipus' => SpaceType::find($this->space_type_id)->name,
            'adreça' => new AddressResource($this->whenLoaded('address')),
            'telefon' => $this->phone, 
            'email' => $this->email, 
            'www' => $this->website,
            'acces' => $this->accessType === 'y' ? 'Sí' : ($this->accessType === 'N' ? 'No' : 'Parcialment accessible'),
            'mitjanaEstatica' => $this->countScore === 0 ? null : round($this->totalScore / $this->countScore,2),
            'mitjanaDinamica' => round($this->calculaMitjana(),2),
            'modalitats' => $this->whenLoaded('modalities', function () {
                return $this->modalities->pluck('name')->implode(', ');
            }),
            'serveis' => $this->whenLoaded('services', function () {
                return $this->services->pluck('name')->implode(', ');
            }),
            $this->mergeWhen($isNested, [
                'comentaris' => CommentResource::collection($this->whenLoaded('comments')),
            ]),
        ];
    }
}
