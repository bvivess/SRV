<?php 
    namespace Databases\Oracle;

    class Database {
        public function connectar() {
            echo "Connexió a Oracle OK." . "<br>";
        }

        public function desconnectar() {
            echo "Desconnexió a Oracle OK." . "<br>";
        }
    }
?>