<?php

namespace App\Docs\Schemas;

/**
 * @OA\Schema(
 * title="Meeting",
 * description="Reunió associada a un Trek",
 * type="object",
 * required={"day", "time", "DNI"}
 * )
 */
class MeetingSchema
{
    /** @OA\Property(format="date", example="2024-12-01") */
    public $day;

    /** @OA\Property(example="09:30:00") */
    public $time;

    /** @OA\Property(description="DNI del responsable de la reunió", example="18224566K") */
    public $DNI;

    /**
     * @OA\Property(
     * property="comments",
     * description="Llista de comentaris associats",
     * type="array",
     * @OA\Items(ref="#/components/schemas/CommentSchema")
     * )
     */
    public $comments;
}