<?php
/**
 * Configuració general de l'aplicació.
 *
 * BASE_PATH: ruta absoluta del projecte al servidor.
 * BASE_URL: ruta del projecte respecte del document root web.
 */
define('BASE_PATH', __DIR__ );

$projectPath = realpath(BASE_PATH);
$documentRoot = $_SERVER['DOCUMENT_ROOT'] ?? '';

if ($documentRoot === '') {
    define('BASE_URL', '');
} else {
    $documentRoot = realpath($documentRoot);
    if ($projectPath === false || $documentRoot === false) {
        throw new RuntimeException('No se pudo resolver la ruta del proyecto o del document root.');
    }

    $projectPath = rtrim(str_replace('\\', '/', $projectPath), '/');
    $documentRoot = rtrim(str_replace('\\', '/', $documentRoot), '/');
    $rootLength = strlen($documentRoot);
    $prefixMatches = DIRECTORY_SEPARATOR === '\\'
        ? strncasecmp($projectPath, $documentRoot, $rootLength) === 0
        : strncmp($projectPath, $documentRoot, $rootLength) === 0;

    if (!$prefixMatches || (strlen($projectPath) > $rootLength && substr($projectPath, $rootLength, 1) !== '/')) {
        throw new RuntimeException('El proyecto debe estar dentro del document root para calcular BASE_URL.');
    }

    define('BASE_URL', rtrim(substr($projectPath, $rootLength), '/'));
}
