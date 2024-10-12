<?php trait FiguraGeometrica {
	
	// Mètode abstracte
    abstract public function calculaArea(): float;  // declarar, no implementar
	
	// Mètode propi
    public function __toString(): string {  // mètode propi del trait 'FiguraGeometrica'
        return get_class($this);
    }
} ?>