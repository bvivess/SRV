<?php
    namespace Figures\Concretes;

    use Figures\Base\FiguraGeometrica;

    class Cercle extends FiguraGeometrica {
        private $radio;

        public function __construct($radio) {
            $this->radio = $radio;
        }

        public function calcularArea() {
            return pi() * pow($this->radio, 2);
        }
    }
?>