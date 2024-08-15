<?php class Persona {
    protected $nom, $edat;

    public function __construct(string $nom, int $edat) {
        $this->nom = $nom;
        $this->edat = $edat;
    }

    public function __toString() {  // en comptes de 'mostraPersona()'
        return "Nom: " . $this->nom . " " . " Edat: " . $this->edat;
    }

    public function equals(Estudiant $p): bool {
        return ($this->nom == $p->nom) && 1 ; // atribut a atribut 
    }
} ?>