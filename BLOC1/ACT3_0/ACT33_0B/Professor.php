<?php class Professor extends  Persona {
	
    // Constructor
    public function __construct(string $nom, int $edat) {
		parent::__construct($nom, $edat);  // Constructor de la Classe
    }
	
    public function __toString(): string {
        return parent::__toString();
    }

} ?>