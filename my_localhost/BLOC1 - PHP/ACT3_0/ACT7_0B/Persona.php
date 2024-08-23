<?php class Persona {
    // Atributs i Constructors
    public function __construct (private string $nom, private int $edat) {

     }

    // Mètodes específics
    public function __toString() {
        return "Nom: " . $this->nom . " Edat: " . $this->edat;
    }

    // Getters i setters
    public function getNom(): string { 
        return $this->nom; 
    }
    public function setNom(string $nom): self { // també 'Persona'
        $this->nom = $nom; 
        return $this;
    }
    public function getEdat(): string { 
        return $this->edat; 
    }
    public function setEdat(string $edat): self { // també 'Persona' 
        $this->edat = $edat; 
        return $this;
    }
} ?>