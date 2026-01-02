<?php

namespace App\Docs\Endpoints;

class TrekDocs
{
    /**
     * @OA\Get(
     * path="/api/trek",
     * tags={"Treks"},
     * summary="Llista tots els treks",
     * operationId="listTreks",
     * @OA\Response(response=200, description="Llista de treks")
     * )
     */
    public function index() {}

    /**
     * @OA\Post(
     * path="/api/trek",
     * tags={"Treks"},
     * summary="Crear un nou trek",
     * operationId="storeTrek",
     * @OA\RequestBody(
     * required=true,
     * @OA\JsonContent(ref="#/components/schemas/TrekSchema")
     * ),
     * @OA\Response(response=200, description="Trek creat correctament")
     * )
     */
    public function store() {}

    /**
     * @OA\Get(
     * path="/api/trek/{trek}",
     * tags={"Treks"},
     * summary="Mostra un trek concret - DESHABILITAT",
     * operationId="showTrek",
     * @OA\Parameter(name="trek", in="path", required=true, @OA\Schema(type="integer")),
     * @OA\Response(response=200, description="Trek mostrat")
     * )
     */
    public function show() {}

    /**
     * @OA\Put(
     * path="/api/trek/{id}",
     * tags={"Treks"},
     * summary="Actualitzar un trek - DESHABILITAT",
     * operationId="updateTrek",
     * @OA\Parameter(name="id", in="path", description="ID del trek", required=true, @OA\Schema(type="integer", example=1)),
     * @OA\Response(response=501, description="Mètode no implementat")
     * )
     */
    public function update() {}

    /**
     * @OA\Delete(
     * path="/api/trek/{id}",
     * tags={"Treks"},
     * summary="Eliminar un trek - DESHABILITAT",
     * operationId="deleteTrek",
     * @OA\Parameter(name="id", in="path", description="ID del trek", required=true, @OA\Schema(type="integer", example=1)),
     * @OA\Response(response=501, description="Mètode no implementat")
     * )
     */
    public function delete() {}

    /**
     * @OA\Get(
     * path="/api/trek/find/{value}",
     * tags={"Treks"},
     * summary="Cerca un trek per ID, regNumber o municipi",
     * description="Si 'value' és numèric cerca per ID, si és text per regNumber o municipi",
     * operationId="findTrek",
     * @OA\Parameter(name="value", in="path", required=true, description="Valor de cerca", @OA\Schema(type="string", example="1")),
     * @OA\Response(response=200, description="Trek trobat correctament"),
     * @OA\Response(response=404, description="Trek no trobat")
     * )
     */
    public function find() {}
}