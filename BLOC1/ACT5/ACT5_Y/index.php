<?php

	spl_autoload_register(function ($class) {
		// Solo cargamos nuestras propias clases
		$namespaces = ['Models', 'Config']; // Define los namespaces que pertenecen a tu aplicación
		foreach ($namespaces as $namespace) {
			if (strpos($class, $namespace . '\\') === 0) {
				// Convertir el namespace en una ruta de archivo
				$class = str_replace('\\', '/', $class) . '.php';
				require_once __DIR__ . '/' . $class;
				break;
			}
		}
	});
	
	// Cargar las clases con los namespaces
	use Models\Employee;

	// Crear un nuevo objeto Employee y guardarlo en la base de datos
	$employee = new Employee('1', 'Tomeu Vives');

	// Guardar el nuevo usuario en la base de datos
	$employee->save();

	// Recuperar todos los usuarios después de la inserción
	$employees = Employee::all();

	foreach ($employees as $e) {
		echo "ID: " . $e->id . "<br>";
		echo "Nombre: " . $e->name . "<br>";
}
