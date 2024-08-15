<?php class Persona {
	// Atributs
	public $nom;
	public $llinatge1;
	public $llinatge2;
	public $edat;
	// Mètodes
	public function mostraPersona(): void {
		echo "Nom: " . $this->nom . " " . $this->llinatge1 . " " . $this->llinatge2;
	}
} ?>