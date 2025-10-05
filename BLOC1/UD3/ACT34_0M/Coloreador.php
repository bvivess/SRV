<?php trait Coloreador {
    private ?string $color;

    //abstract public function aplicaColor(string $color): void;  // declarar, no implementar
	
	public function aplicaColor(string $color): void {  // o bé 'setColor()'
		$this->color = $color;
	}
	
		
	public function getColor(): string {
		return $this->color;
	}
    
} ?>