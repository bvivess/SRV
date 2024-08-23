<?php
    namespace Figures\Concretes;

    use Figures\Base\FiguraGeometrica;

    class Quadrat extends FiguraGeometrica {
        private $base;
        private $altura;

        public function __construct($base) {
            $this->base = $base;
        }

        public function calcularArea() {
            return ($this->base * $this->base);
        }
    }
?>