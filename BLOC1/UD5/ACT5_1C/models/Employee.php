<?php

namespace models;

use config\Database;

class Employee extends Model {
    // Definir la taula associada a la classe
    protected static $table = 'employees';

	    // Constructor
		public function __construct(    
			public int $employee_id,
			public ?string $first_name=null,
			public ?string $last_name=null,
			public ?string $email=null,
			public ?string $phone_number=null,
			public ?string $hire_date=null,
			public ?string $job_id=null,
			public ?float $salary=null,
			public ?float $commission_pct=null,
			public ?int $manager_id=null,
			public ?int $department_id=null
		) { }

    // Mètode per guardar l'empleat a la base de dades
    public function save() {
        // Carregar la configuració de la base de dades
        $config = Database::loadConfig('C:/temp/config.db');
		$db = new Database(
			$config['DB_HOST'], 
			$config['DB_PORT'], 
			$config['DB_DATABASE'], 
			$config['DB_USERNAME'], 
			$config['DB_PASSWORD']
		);

		// Connectar a la base de dades
		$db->connectDB();

		// Obtenir el nom de la taula de la classe filla
		$table = static::$table; 

        // Connectar a la base de dades
		if (isset($this->employee_id)) {
			$sql = "SELECT * FROM $table WHERE employee_id = $this->employee_id";
			$result = $db->conn->query($sql);

			// Comprovar si hi ha resultats
			if ($result->num_rows == 1) {
				$sql = "UPDATE $table 
					   SET first_name = ?,
						   last_name = ?,
         				   email = ?,
						   phone_number = ?,
						   hire_date = ?,
						   job_id = ?,
						   salary = ?,
						   commission_pct = ?,
						   manager_id = ?,
						   department_id = ?
						WHERE employee_id = ?";
				$stmt = $db->conn->prepare($sql);
				// Vincular els valors
				$stmt->bind_param( "ssssssddiii", 
										$this->first_name, 
										$this->last_name, 
										$this->email, 
										$this->phone_number, 
										$this->hire_date, 
										$this->job_id, 
										$this->salary, 
										$this->commission_pct, 
										$this->manager_id, 
										$this->department_id,
										$this->employee_id
								 );
				// Executar la consulta
				if ($stmt->execute()) {
					echo "L'empleat s'ha modificat correctament.";
				} else {
					echo "Error modificant l'empleat: " . $stmt->error;
				}

			} else {
				// Preparar la consulta d'INSERT
				$sql = "INSERT INTO  $table (employee_id, first_name, last_name, email, phone_number, hire_date, job_id, salary, commission_pct, manager_id, department_id) 
						VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

				$stmt = $db->conn->prepare($sql);
				// Vincular els valors
				$stmt->bind_param( "issssssddii", 
										$this->employee_id, 
										$this->first_name, 
										$this->last_name, 
										$this->email, 
										$this->phone_number, 
										$this->hire_date, 
										$this->job_id, 
										$this->salary, 
										$this->commission_pct, 
										$this->manager_id, 
										$this->department_id
								 );

				// Executar la consulta
				if ($stmt->execute()) {
					echo "L'empleat s'ha afegit correctament.";
				} else {
					echo "Error en afegir l'empleat: " . $stmt->error;
				}
			}
			// Variant per a MySQL: executa INSERT/UPDATE a la vegada
			/*
			$sql = "INSERT INTO $table (employee_id, first_name, last_name, email, phone_number, hire_date, job_id, salary, commission_pct, manager_id, department_id) 
			VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
			ON DUPLICATE KEY UPDATE
				first_name = VALUES(first_name),
				last_name = VALUES(last_name),
				email = VALUES(email),
				phone_number = VALUES(phone_number),
				hire_date = VALUES(hire_date),
				job_id = VALUES(job_id),
				salary = VALUES(salary),
				commission_pct = VALUES(commission_pct),
				manager_id = VALUES(manager_id),
				department_id = VALUES(department_id)";
			$stmt = $db->conn->prepare($sql);
			$stmt->bind_param(...);
			$stmt->execute();
			*/
		} else {
			echo "Error, ID no informat";
		}

        // Tancar la connexió
        $db->closeDB();
    }
}

?>

