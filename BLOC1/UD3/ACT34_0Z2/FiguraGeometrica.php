<?php trait FiguraGeometrica {
    // Mètodes abstractes
    abstract public function calculaArea(): float;
    abstract public function calculaPerimetre(): float;
    abstract public function calculaNCostats(): int;

    // Métodes concrets
    public function getClass(): String {
        return get_class($this);
    }
    
    public function __toString(): string {
        return $this->getClass() . "-->" .
               ", Área: " . round($this->calculaArea(),2) .
               ", Perímetre: " . round($this->calculaPerimetre(),2) . 
               ", Costats: " . $this->calculaNCostats();
    }
} ?>