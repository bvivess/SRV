<?php class Persona {
    protected $nom, $edat;
    // Constructor
    public function __construct(string $nom, int $edat) {
        $this->nom = $nom;
        $this->edat = $edat;
    }
    public function mostraPersona(): void {
        echo "Nom: " . $this->nom . " " . " Edat: " . $this->edat;
    }
} ?>