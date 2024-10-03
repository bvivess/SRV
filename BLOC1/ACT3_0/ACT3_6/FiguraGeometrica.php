<?php trait FiguraGeometrica {
    abstract public function calculaArea(): float;  // declarar, no implementar

    public function nomFigura(): string {  // mètode propi del trait 'FiguraGeometrica'
        return get_class($this);
    }
} ?>