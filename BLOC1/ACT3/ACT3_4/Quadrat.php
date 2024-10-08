<?php class Quadrat implements FiguraGeometrica, Coloreador {
    // Constructor
    public function __Construct(
        private ?string $color=null, 
        private float $costat=0 ) { }
		
    // Implementació del mètode abstracte de 'FiguraGeometrica'
    public function calculaArea(): float {
        return pow($this->costat, 2);
    }
    // Implementació del mètode abstracte de 'Coloreador'
    public function aplicaColor(string $color): void {
        $this->color = $color;
    }
	
    public function __toString(): string {
        return "Color: " . $this->color . "; Costat: " . $this->costat . "; Àrea " . $this->calculaArea();
    }
}

