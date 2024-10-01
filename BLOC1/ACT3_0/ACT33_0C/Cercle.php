<?php class Cercle extends FiguraGeometrica {

    // Constructor
    public function __construct(string $color, private float $radi) {
        parent::__construct($color);  // Llamar al constructor de la clase padre
    }
    
    public function calculaArea(): float {
        return M_PI * pow($this->radi, 2);
    }
	
	public function __toString(): string {
		return parent::__toString() . "; Àrea: " . $this->calculaArea() ;
	}
} ?>