<?php
class Theme {
    private int $id_theme;
    private string $name;

    public function __construct(string $name) {
        $this->name = $name;
    }

    public function getIdTheme(): int {
        return $this->id_theme;
    }

    public function getName(): string {
        return $this->name;
    }

    public function setName(string $name): void {
        $this->name = $name;
    }
}
?>