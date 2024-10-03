<?php abstract class Coloreador {
	
	// Constructor
	public function __construct(
        private ?string $color=null ) { }
		
    // Mètodes abstractes
    abstract public function aplicaColor(string $color): void;    // declarar, no implementar
} ?>