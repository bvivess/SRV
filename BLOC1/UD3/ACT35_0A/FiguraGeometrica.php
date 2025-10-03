<?php trait FiguraGeometrica {
    
    abstract public function calculaArea(): float;  // declarar, no implementar
	
	public function getClass(): String {
		return get_class($this);
	}
	
	public function __toString(): string {
      return $this->getClass() . "--> Color: " . 
             $this->getColor() . ", Área: " . round($this->calculaArea(),2);
  }

} ?>