<?php

namespace App\Docs\Endpoints;

class AuthDocs
{
    /**
     * @OA\Post(
     * path="/api/login",
     * tags={"Auth"},
     * summary="Autentica un usuari",
     * operationId="login",
     * @OA\RequestBody(
     * required=true,
     * @OA\JsonContent(
     * required={"email", "password"},
     * @OA\Property(property="email", type="string", format="email", example="admin@baleartrek.com"),
     * @OA\Property(property="password", type="string", format="password", example="12345678")
     * )
     * ),
     * @OA\Response(
     * response=200,
     * description="Login correcte",
     * @OA\JsonContent(@OA\Property(property="token", type="string", example="eyJ0eXAiOiJKV1Qi..."))
     * ),
     * @OA\Response(response=401, description="Credencials incorrectes")
     * )
     */
    public function login() {}

    /**
     * @OA\Post(
     * path="/api/logout",
     * tags={"Auth"},
     * summary="Tanca la sessió de l'usuari actual",
     * operationId="logout",
     * security={{"sanctum":{}}},
     * @OA\Response(
     * response=200,
     * description="Logout correcte",
     * @OA\JsonContent(@OA\Property(property="message", type="string", example="Logout OK successful"))
     * ),
     * @OA\Response(response=401, description="Usuari no autenticat"),
     * @OA\Response(response=500, description="Error al tancar la sessió")
     * )
     */
    public function logout() {}

    /**
     * @OA\Post(
     * path="/api/register",
     * tags={"Auth"},
     * summary="Registra un nou usuari",
     * operationId="register",
     * @OA\RequestBody(
     * required=true,
     * @OA\JsonContent(
     * required={"name", "lastname", "email", "dni", "phone", "password", "password_confirmation"},
     * @OA\Property(property="name", type="string", example="prova"),
     * @OA\Property(property="lastname", type="string", example="prova"),
     * @OA\Property(property="email", type="string", format="email", example="prova@abc.com"),
     * @OA\Property(property="dni", type="string", example="43044380H"),
     * @OA\Property(property="phone", type="string", example="600000001"),
     * @OA\Property(property="password", type="string", format="password", example="12345678"),
     * @OA\Property(property="password_confirmation", type="string", format="password", example="12345678")
     * )
     * ),
     * @OA\Response(
     * response=201,
     * description="Usuari registrat correctament amb token",
     * @OA\JsonContent(
     * @OA\Property(property="access_token", type="string"),
     * @OA\Property(property="token_type", type="string", example="Bearer")
     * )
     * ),
     * @OA\Response(response=400, description="Error de validació")
     * )
     */
    public function register() {}
}