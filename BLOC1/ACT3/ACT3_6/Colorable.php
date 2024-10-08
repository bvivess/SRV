<?php trait Colorable {
    protected $color;

	// Mètode abstacte
    abstract public function aplicaColor(string $color): void;    // declarar, no implementar
} ?>