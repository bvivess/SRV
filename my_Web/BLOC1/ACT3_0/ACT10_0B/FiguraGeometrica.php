<?php require_once('Colorable.php'); trait FiguraGeometrica {
    use Colorable;
    abstract public function calculaArea(): float;  // declarar, no implementar

    public function nomFigura(): string {  // mètode propi del trait 'FiguraGeometrica'
        return get_class($this);
    }
} ?>