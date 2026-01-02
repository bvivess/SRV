<?php

namespace App\Docs\Schemas;

/**
 * @OA\Schema(
 * title="User",
 * description="Model d'usuari",
 * type="object"
 * )
 */
class UserSchema {
    /** @OA\Property(property="id", type="integer", example=1) */
    public $id;

    /** @OA\Property(property="name", type="string", example="Joan") */
    public $name;

    /** @OA\Property(property="lastname", type="string", example="Garcia") */
    public $lastname;

    /** @OA\Property(property="dni", type="string", example="43044380H") */
    public $dni;

    /** @OA\Property(property="email", type="string", format="email", example="joan@example.com") */
    public $email;

    /** @OA\Property(property="phone", type="string", example="600000001") */
    public $phone;

    /** @OA\Property(property="status", type="string", example="y") */
    public $status; // 'y' per actiu, 'n' per inactiu

    //** @OA\Property(property="role_id", type="integer", example=2) */
    public $role_id;

    /** @OA\Property(property="created_at", type="string", format="date-time", example="2023-10-01T12:34:56Z") */
    public $created_at; 
    /** @OA\Property(property="updated_at", type="string", format="date-time", example="2023-10-10T15:20:30Z") */
    public $updated_at;
}