<?php require_once('Colorable.php'); 
      require_once('FiguraGeometrica.php'); 
    class Cercle { 
		use Colorable, FiguraGeometrica;
	
    // Constructor
    public function __construct(private string $color, private float $radi) {
        $this->setColor($color);
        $this->radi = $radi;
    }
	
    public function calculaArea(): float {
        return pi() * pow($this->radi, 2);
    }
	
    public function __toString(): string {
        return "Color: " . $this->getColor() . ", Área: " . $this->calculaArea();
    }

} ?>