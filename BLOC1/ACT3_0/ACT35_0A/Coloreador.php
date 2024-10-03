<?php trait Coloreador {
    protected $color;

    //abstract public function aplicaColor(string $color): void;  // declarar, no implementar
	
	public function aplicaColor(string $color): void {
		$this->color = $color;
	}
    
} ?>