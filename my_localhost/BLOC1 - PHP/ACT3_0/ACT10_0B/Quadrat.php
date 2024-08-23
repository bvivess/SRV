<?php require_once('FiguraGeometrica.php'); 
    class Quadrat {
    use FiguraGeometrica;
    private $costat;
    // Constructor
    public function __construct(string $color, float $costat) {
        $this->setColor($color);
        $this->costat = $costat;
    }

    public function calculaArea(): float {
        return pow($this->costat, 2);
    }
} ?>