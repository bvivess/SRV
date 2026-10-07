<?php
    require_once('FiguraGeometrica.php');
    class Quadrat {
        use FiguraGeometrica;
    private $costat;
    // Constructor
    public function __construct(float $costat) {
        $this->costat = $costat;
    }

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
