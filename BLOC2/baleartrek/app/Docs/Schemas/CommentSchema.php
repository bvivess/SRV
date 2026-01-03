<?php

namespace App\Docs\Schemas;

/**
 * @OA\Schema(
 * title="Comment",
 * description="Comentari dins d'una reunió",
 * type="object",
 * required={"DNI", "comment", "score"}
 * )
 */
class CommentSchema
{
    /** @OA\Property(example="18224566K") */
    public $DNI;

    /** @OA\Property(example="Ruta molt variada, especialment recomanable a la primavera.") */
    public $comment;

    /** @OA\Property(example=2, type="integer") */
    public $score;
}