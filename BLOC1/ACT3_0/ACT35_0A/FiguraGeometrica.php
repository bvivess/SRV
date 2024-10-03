<?php trait FiguraGeometrica {
    
    abstract public function calculaArea(): float;  // declarar, no implementar
	
	public function __toString(): String {
		return get_class($this);
	}
    
} ?>