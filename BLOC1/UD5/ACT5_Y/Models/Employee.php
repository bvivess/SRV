<?php

	namespace Models;
	
	use Config\Config; // Asegúrate de que este uso esté correctamente definido


	class Employee extends Model {
		protected static $table = 'employees';  // Tabla asociada al modelo
		
		// Declaración de las propiedades
		private $employee_id;
		private $name;

		// Constructor para inicializar los atributos del modelo
		public function __construct($employee_id, $name) {
			$this->employee_id = $employee_id;
			$this->name = $name;
		}

		// Método para insertar o actualizar un registro
		public function save() {
			$conn = static::getConnection();
			$table = static::$table;

			// Si el objeto ya tiene un ID, actualizamos el existente
			if ($this->employee_id) {
				$query = $conn->prepare("UPDATE $table SET name = ? WHERE id = ?");
				$query->bind_param("si", $this->name, $this->id);
			} else {
				// Si no tiene ID, insertamos un nuevo registro
				$query = $conn->prepare("INSERT INTO $table (employee_id, name) VALUES (?, ?)");
				$query->bind_param("ss", $this->employee_id, $this->name);
			}

			// Ejecutar la consulta
			if ($query->execute()) {
				if (!$this->employee_id) {
					// Asignar el nuevo ID si se ha insertado
					$this->id = $conn->insert_id;
					echo "Nuevo usuario insertado con ID: " . $this->id . "<br>";
				} else {
					echo "Usuario actualizado correctamente.<br>";
				}
			} else {
				echo "Error al guardar el usuario: " . $query->error . "<br>";
			}

			// Cerrar la conexión
			$conn->close();
		}
	}

?>
