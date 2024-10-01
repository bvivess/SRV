<?php class Quadrat extends FiguraGeometrica {
    
    // Constructor
    public function __construct(string $color, private float $costat) {
		parent::__construct($color);
    }

    public function calculaArea(): float {
        return pow($this->costat, 2);
    }
	
	public function __toString(): string {
		return parent::__toString() . "; Àrea: " . $this->calculaArea();
	}
} ?>