<?php

    namespace App\Models;

    class Employee {
        private $employee_id;
        private $name;
        private $db_conn;

        public function __construct($employee_id, $name) {
            $this->employee_id = $employee_id;
            $this->employee_name = $name;
        }

        public function save() {
            $stmt = $this->db_conn->prepare("INSERT INTO employees (employee_id, name) VALUES (?, ?)");

            if ($stmt === false) {
                die("Error en la preparació de la consulta: " . $this->db_conn->error);
            }

            $stmt->bind_param("is", $this->employee_id, $this->name);

            if ($stmt->execute()) {
                echo "Inserció realitzada correctament per l'empleat {$this->name}.<br>";
            } else {
                echo "Error en la inserció: " . $stmt->error . "<br>";
            }

            $stmt->close();
        }
    }

?>
