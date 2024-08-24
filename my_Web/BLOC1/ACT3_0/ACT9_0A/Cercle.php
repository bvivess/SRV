<?php class Cercle implements FiguraGeometrica1 {
    private $radi;

    // Constructor
    public function __construct(float $radi) {
        $this->radi = $radi;
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

} ?>