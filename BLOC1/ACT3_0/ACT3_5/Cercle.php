<?php class Cercle extends Coloreador implements FiguraGeometrica {
	
    // Constructor
    public function __construct(
        private ?string $color=null, 
        private float $radi=0 ) {
			parent::__Construct($color);
		}
		
    // Implementació del mètode abstracte de 'FiguraGeometrica'
    public function calculaArea(): float {
        return M_PI * pow($this->radi, 2);
    }
    // Implementació del mètode abstracte de 'Coloreador'
    public function aplicaColor(string $color): void {
        $this->color = $color;
    }
	
    public function __toString(): string {
        return "Color: " . $this->color . "; Radi: " . $this->radi . "; Àrea " . $this->calculaArea();
    }
}

