<?php
    class Quadrat extends FiguraGeometrica {

    // Constructor
    public function __construct(private string $color, private float $costat) {
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

    public function getColor(): string {
        return $this->color;
    }
	
}
