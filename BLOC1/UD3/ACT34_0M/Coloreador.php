<?php trait Coloreador {
    private ?string $color;

    //abstract public function aplicaColor(string $color): void;  // declarar, no implementar
	
	// Implementació como a ètode 'concret' en comptes de com a mètode 'abstracte'
	public function aplicaColor(string $color): void {  // o bé 'setColor()'
		$this->color = $color;
	}
	
		
	public function getColor(): string {
		return $this->color;
	}
    
} ?>