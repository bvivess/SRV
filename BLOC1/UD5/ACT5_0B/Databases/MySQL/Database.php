<?php 
    namespace Databases\MySQL;

    class Database {
        public function connectar() {
            echo "Connexió a MySQL OK." . "<br>";
        }

        public function desconnectar() {
            echo "Desconnexió a MySQL OK." . "<br>";
        }
    }
?>