<?php class Quadrat {
    // Atributs i Constructors
    public function __construct (
        protected int $costat, 
        protected float $area=0, 
        protected float $perimetre=0,
        protected int $nCostats=0 ) {

     }

    // Mètodes específics
    public function calculaArea(): self {
        $this->area = pow($this->costat, 2); 
        return $this;
    }

    public function calculaPerimetre(): self {
        $this->perimetre = $this->costat * 4; 
        return $this;
    }

    public function calculaNCostats(): self {
        $this->nCostats = 4; 
        return $this;
    }

    public function __toString() {
        return "Quadrat, costat: " . $this->costat;
    }
   
    public function getCostat(): int {
        return $this->costat;
    }
    public function setCostat(int $costat): self {
        $this->costat = $costat;
        return $this;
    }
} ?>