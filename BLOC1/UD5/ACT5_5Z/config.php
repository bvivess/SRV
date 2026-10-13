<?php
/**
 * Configuració general de l'aplicació.
 *
 * BASE_PATH: ruta absoluta del projecte al servidor.
 * BASE_URL: ruta del projecte respecte del document root web.
 */
define('BASE_PATH', __DIR__);

define(
    'BASE_URL',
    rtrim(str_replace('\\', '/', substr(BASE_PATH, strlen($_SERVER['DOCUMENT_ROOT']))), '/')
);
