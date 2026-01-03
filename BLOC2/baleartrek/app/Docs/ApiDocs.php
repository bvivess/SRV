<?php

namespace App\Docs;
    /**
     * @OA\Info(
     * version="1.0.0",
     * title="API Baleartrek",
     * description="Documentació de l'API Baleartrek"
     * )
     *
     * @OA\Server(
     * url=L5_SWAGGER_CONST_HOST,
     * description="Servidor principal"
     * )
     *
     * @OA\SecurityScheme(
     * securityScheme="sanctum",
     * type="http",
     * scheme="bearer",
     * description="Introdueix el token en format: Bearer {token}"
     * )
     */
class ApiDocs {}