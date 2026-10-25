<?php
	use models\Employee;

	require_once dirname(__DIR__, 3) . '/src/config/config.php';
	require_once BASE_PATH . '/vendor/autoload.php';

	function convertToNull($value) {
		return $value === '' ? null : $value;
	}

	// Definim el gestor d’errors personalitzat
	function gestorErrors($errno, $errstr, $errfile, $errline) {
		// Convertim l’error en una excepció
		throw new ErrorException($errstr, 0, $errno, $errfile, $errline);
	}

	// Registrem el gestor d’errors
	set_error_handler("gestorErrors");

	$errorMessage = null;
	$status = null;

    try {
		// Si el formulari ha estat enviat
		if ($_SERVER["REQUEST_METHOD"] == "GET") {
			// Crear una nova instància d'Employee amb els valors del formulari


			// Guardar l'empleat a la base de dades
            $employee = Employee::find((int) $_GET['employee_id']);
            print_r($employee);
		}
	} catch (Error | Exception $e) {
		// Missatge amigable a l'usuari
		$errorMessage = "Error al seleccionar l'empleat: " . $e->getMessage();
	}
?>