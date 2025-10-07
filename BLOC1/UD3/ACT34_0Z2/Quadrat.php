<?php
    require_once 'FiguraGeometrica.php';
    class Quadrat {
        
        use FiguraGeometrica;
    // Constructor
    public function __construct(private string $color, private float $costat) {  }   

    // Implementació dels mètodes
    public function calculaArea(): float {
        return pow($this->costat, 2);
    }

    public function calculaPerimetre(): float {
        return $this->costat * 4;
    }

    public function calculaNCostats(): int {
        return 4;
    }
	
}
