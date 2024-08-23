<?php class Estudiant extends  Persona {
    private $curs;
    // Constructor
    public function __construct(string $nom, int $edat, string $curs) {
parent::__construct($nom, $edat);  // Constructor de la Superclasse
        $this->curs = $curs;
    }
    public function mostraEstudiant(): void {
        echo "Nom: " . $this->nom . " " . "Curs: " . $this->curs;
    }
} ?>