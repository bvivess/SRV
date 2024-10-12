<?php require_once('Colorable.php'); 
      require_once('FiguraGeometrica.php'); 
    class Cercle {
    use Colorable, FiguraGeometrica;

    // Constructor
    public function __construct(
        ?string $color=null, 
        private float $radi=0 ) { }
		
	// Implementació del mètode abstracte de 'FiguraGeometrica'
    public function calculaArea(): float {
        return pi() * pow($this->radi, 2);
    }
	
	// Implementació del mètode abstracte de 'Coloreador'
	public function aplicaColor(string $color): void {
        $this->color = $color;
    }
} ?>