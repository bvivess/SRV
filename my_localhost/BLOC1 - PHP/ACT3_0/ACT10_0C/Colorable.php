<?php trait Colorable {
    protected $color;

    public function getColor(): string {
        return $this->color;
    }
    public function setColor(string $color): void {
        $this->color = $color;
    }
} ?>