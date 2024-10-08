<?php
    namespace Figures\Concretes;

    use Figures\Base\FiguraGeometrica;

    class Rectangle extends FiguraGeometrica {
        private $ancho;
        private $alto;

        public function __construct($ancho, $alto) {
            $this->ancho = $ancho;
            $this->alto = $alto;
        }

        public function calcularArea() {
            return $this->ancho * $this->alto;
        }
    }
?>