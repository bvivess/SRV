<?php

namespace App\Docs\Endpoints;

class UserDocs
{
    /**
     * @OA\Get(
     * path="/api/user",
     * tags={"Users"},
     * summary="Llista tots els usuaris actius",
     * operationId="listUsers",
     * @OA\Response(
     * response=200,
     * description="Llista d'usuaris actius",
     * @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/UserSchema"))
     * )
     * )
     */
    public function index() {}

    /**
     * @OA\Get(
     * path="/api/user/{user}",
     * tags={"Users"},
     * summary="Mostra un usuari concret",
     * operationId="showUser",
     * @OA\Parameter(name="user", in="path", description="ID de l'usuari", required=true, @OA\Schema(type="integer", example=1)),
     * @OA\Response(
     * response=200,
     * description="Usuari trobat",
     * @OA\JsonContent(ref="#/components/schemas/UserSchema")
     * ),
     * @OA\Response(response=404, description="Usuari no disponible")
     * )
     */
    public function show() {}

    /**
     * @OA\Put(
     * path="/api/user/{user}",
     * tags={"Users"},
     * summary="Actualitza un usuari",
     * operationId="updateUser",
     * @OA\Parameter(name="user", in="path", description="ID de l'usuari", required=true, @OA\Schema(type="integer", example=1)),
     * @OA\RequestBody(
     * required=true,
     * @OA\JsonContent(
     * required={"name", "lastname", "dni", "phone"},
     * @OA\Property(property="name", type="string", example="prova"),
     * @OA\Property(property="lastname", type="string", example="prova"),
     * @OA\Property(property="dni", type="string", example="43044380H"),
     * @OA\Property(property="phone", type="string", example="600000001")
     * )
     * ),
     * @OA\Response(
     * response=200,
     * description="Usuari modificat correctament",
     * @OA\JsonContent(ref="#/components/schemas/UserSchema")
     * ),
     * @OA\Response(response=404, description="Usuari no disponible")
     * )
     */
    public function update() {}

    /**
     * @OA\Delete(
     * path="/api/user/{user}",
     * tags={"Users"},
     * summary="Elimina un usuari",
     * operationId="deleteUser",
     * @OA\Parameter(name="user", in="path", description="ID de l'usuari", required=true, @OA\Schema(type="integer", example=1)),
     * @OA\Response(
     * response=200,
     * description="Usuari eliminat correctament",
     * @OA\JsonContent(@OA\Property(property="meta", type="string", example="Usuari eliminat correctament"))
     * ),
     * @OA\Response(response=500, description="Error en eliminar l'usuari")
     * )
     */
    public function delete() {}
}