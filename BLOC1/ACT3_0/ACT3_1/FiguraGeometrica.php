<?php class FiguraGeometrica {

    // Constructor
    public function __construct(
        protected string $color
    ) { }
    
    // Método __toString debe devolver un string
    public function __toString(): string {  
        return "Color: " . $this->color;
    }
} ?>