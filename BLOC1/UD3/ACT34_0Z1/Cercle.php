<?php
    class Cercle extends FiguraGeometrica {

    // Constructor
    public function __construct(private string $color, private float $radi) {
    }

    // Implementació del mètode
    public function calculaArea(): float {
        return pi() * pow($this->radi, 2);
    }

    public function calculaPerimetre(): float {
        return 2 * pi() * $this->radi;
    }

    public function calculaNCostats(): int {
        return 0;
    }
	
    public function getColor(): string {
        return $this->color;
    }   
    
} ?>