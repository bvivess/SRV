<?php require_once('Colorable.php'); 
      require_once('FiguraGeometrica.php'); 
    class Cercle {
    use Colorable, FiguraGeometrica;
    private $radi;
    // Constructor
    public function __construct(string $color, float $radi) {
        $this->setColor($color);
        $this->radi = $radi;
    }
    public function calculaArea(): float {
        return pi() * pow($this->radi, 2);
    }
} ?>