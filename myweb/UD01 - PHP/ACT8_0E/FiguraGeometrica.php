<?php abstract class FiguraGeometrica {
    protected $color;
    
    // Constructor
    public function __construct(string $color) {
        $this->color = $color;
    }

    abstract public function calculaArea(): float;  // declarar, no implementar
    
    public function __toString() {  // mètode propi de la classe 'FiguraGeometrica'
        echo "El color de la figura es: " . $this->color;
    }
} ?>