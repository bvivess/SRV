<?php

namespace App\Docs\Schemas;

/**
 * @OA\Schema(
 * title="Trek",
 * description="Model principal de Trek",
 * type="object",
 * required={"regNumber", "name", "municipality"}
 * )
 */
class TrekSchema
{
    /** @OA\Property(example="T99") */
    public $regNumber;

    /** @OA\Property(example="Parc Natural de Llevant") */
    public $name;

    /** @OA\Property(example="Artà") */
    public $municipality;

    /**
     * @OA\Property(
     * property="meetings",
     * description="Llista de reunions programades per aquest trek",
     * type="array",
     * @OA\Items(ref="#/components/schemas/MeetingSchema")
     * )
     */
    public $meetings;
}