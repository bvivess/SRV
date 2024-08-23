<?php class Persona {
    // Atributs
    private $nom;

    // Constructors
    public function __construct (string $nom) { $this->nom = $nom; }
    // Mètodes específics 
    /** … PHPdoc del mètode específic 1 … */
    public function metodeEspecific1(): void { null; }

    // Getters i setters
    public function getNom(): string { return $this->nom; }
    public function setNom(string $nom): void { $this->nom = $nom; }
} ?>