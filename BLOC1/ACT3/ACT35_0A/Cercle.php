<?php 
    require_once 'FiguraGeometrica.php';
	require_once 'Coloreador.php';
    class Cercle {
		use FiguraGeometrica;
		use Coloreador;

		// Constructor
		public function __construct(
			?string $color=null, 
			private float $radi=0) {

		}
	
		public function getColor(): string {
			return $this->color;
		}
		
		public function calculaArea(): float {
			return pi() * pow($this->radi, 2);
		}
		
    }
?>