<?php 
    class Calculadora {
        public static $pi = 3.1416;

        public static function sumar($a, $b) {
            return $a + $b;
        }

        public static function calcularAreaCercle($radi) {
            return self::$pi * pow($radi,2);
        }
    } 

    // Accés a la funció estàtica
    echo Calculadora::sumar(5, 3) . "<br>";  
    echo "L'àrea d'un cercle amb radi 2 és: " . Calculadora::calcularAreaCercle(2) . "<br>";
    // Accés a un atribut estàtic
    echo "El valor de PI és: " . Calculadora::$pi;  
?>