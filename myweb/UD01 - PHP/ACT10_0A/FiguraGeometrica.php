<?php trait FiguraGeometrica {
    protected $color;

    // Constructor en el Trait
    public function __construct($color) {
        $this->color = $color;
    }
    
    abstract public function calculaArea(): float;  // declarar, no implementar
    
    public function nomFigura(): string {  // mètode propi del trait 'FiguraGeometrica'
        return get_class($this);
    }
} ?>