<?php 
    require_once 'FiguraGeometrica.php';
	require_once 'Coloreador.php';
    class Quadrat {
		use FiguraGeometrica;
		use Coloreador;

		// Constructor
		public function __construct( string $color=null, 
									 private float $costat=0) {
		}
		
		public function calculaArea(): float {
			return round(pow($this->costat, 2),2);
		}


    }
?>