<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MeetingResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [  
            'identificador' => $this->id,
            'trek' => new TrekResource($this->whenLoaded('trek')),  // 1:N -> cal tornar una col: collection[comments()]
            'user' => new UserResource($this->whenLoaded('user')),  // 1:N -> cal tornar una col: collection[comments()]
            'day' => $this->day,
            'time' => $this->time,
            'appDateInit' => $this->appDateIni,
            'appDateEnd' => $this->appDateEnd,
            'mitjanaEstatica' => $this->countScore === 0 ? null : round($this->totalScore / $this->countScore,2),
            'mitjanaDinamica' => round($this->calculaMitjana(),2),
            'vots' => $this->countScore,
        ];
    }
}
