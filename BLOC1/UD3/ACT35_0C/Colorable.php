<?php trait Colorable {
    private string $color;

    public function setColor(string $color): void {
        $this->color = $color;
    }

    public function getColor(): string {  // en comptes de '__toString()'
        return $this->color;
    }
} ?>