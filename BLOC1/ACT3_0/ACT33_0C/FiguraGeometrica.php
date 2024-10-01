<?php  abstract class FiguraGeometrica {

    // Constructor
    public function __construct(
        protected string $color
    ) { }

    abstract public function calculaArea(): float;  // declarar, no implementar
    
    // Método __toString debe devolver un string
    public function __toString(): string {  
        return "Color: " . $this->color;
    }
} ?>