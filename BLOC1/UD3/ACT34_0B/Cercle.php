<?php class Cercle implements FiguraGeometrica, Coloreador {
    // Constructor
    public function __Construct(
        private ?string $color=null, 
        private float $radi=0 ) { }
	
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
