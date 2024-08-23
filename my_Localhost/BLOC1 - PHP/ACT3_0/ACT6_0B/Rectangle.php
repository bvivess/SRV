<?php class Rectangle {
	// Atributs
    public $amplada, $alcada;
	// Mètodes
	public function calcularArea(): float {
        return $this->amplada * $this->alcada;
    }
	public function calcularPerimetre(): float {
        return 2 * ($this->amplada + $this->alcada);
    }
} ?>