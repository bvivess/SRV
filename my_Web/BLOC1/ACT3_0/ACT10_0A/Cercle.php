<?php 
    require_once 'FiguraGeometrica.php';
    class Cercle {
    use FiguraGeometrica;
    private $radi;

    // Constructor
    public function __construct(string $color, float $radi) {
        // FiguraGeometrica::__construct($color);
        $this->color = $color;
        $this->radi = $radi;
    }
    
    public function calculaArea(): float {
        return pi() * pow($this->radi, 2);
    }
} ?>