<?php

    namespace models;
    
    use config\config;

    class Employee extends Model {
        protected static $table = 'employees';  // Taula associada al model

        private $employee_id;
        private $name;

        // Constructor per inicialitzar els atributs del model
        public function __construct($employee_id, $name) {
            $this->employee_id = $employee_id;
            $this->employee_name = $name;
        }
    }

    // Mètode per inserir un nou registre
    public function save() {
        $conn = static::getConnection();
        $table = static::$table;

        // Si l'objecte ja té un ID, actualitzem l'existent
        if ($this->id) {
            $query = $conn->prepare("UPDATE $table SET name = ? WHERE id = ?");
            $query->bind_param("si", $this->name, $this->id);
        } else {
            // Si no té ID, inserim un nou registre
            $query = $conn->prepare("INSERT INTO $table (employee_id, name) VALUES (?, ?)");
            $query->bind_param("ss", $this->employee_id, $this->name);
        }

        // Executar la consulta
        if ($query->execute()) {
            if (!$this->id) {
                // Assignar el nou ID si s'ha inserit
                $this->id = $conn->insert_id;
                echo "Nou usuari inserit amb ID: " . $this->id . "<br>";
            } else {
                echo "Usuari actualitzat correctament.<br>";
            }
        } else {
            echo "Error en desar l'usuari: " . $query->error . "<br>";
        }

        // Tancar la connexió
        $conn->close();
    }

?>
