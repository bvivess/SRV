<?php require_once('Colorable.php'); 
      require_once('FiguraGeometrica.php');
    class Quadrat {
    use Colorable, FiguraGeometrica;
	
    // Constructor
    public function __construct(
		?string $color=null, 
		private float $costat=0 ) {  }
	
	// Implementació del mètode abstracte de 'FiguraGeometrica'
    public function calculaArea(): float {
        return pow($this->costat, 2);
    }
	
	// Implementació del mètode abstracte de 'Coloreador'
	public function aplicaColor(string $color): void {
        $this->color = $color;
    }
} ?>