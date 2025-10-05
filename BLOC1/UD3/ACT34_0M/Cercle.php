<?php 
    require_once 'FiguraGeometrica.php';
	require_once 'Coloreador.php';
    class Cercle {
		use FiguraGeometrica;
		use Coloreador;

		// Constructor
		public function __construct( private ?string $color=null, 
									 private float $radi=0) {
		}
		
		public function calculaArea(): float {
			return round(pi() * pow($this->radi, 2),2);
		}


		
    }
?>