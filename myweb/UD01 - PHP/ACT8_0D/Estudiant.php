<?php class Estudiant extends Persona {
    private $curs;

    public function __construct(string $nom, int $edat, String $curs) {
        parent::__construct($nom, $edat);  // Constructor de la Superclasse
        $this->curs = $curs;
    }

    public function __toString() { 
        return parent::__toString() . " " . "Curs: " . $this->curs;
    }

	public function equals(Estudiant $e): bool {
		return (parent::equals($e)) && ($this->curs == $e->curs);
	}

}?>