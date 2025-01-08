<?php
class Tag {
    private int $id_tag;
    private string $description;
    private string $name;

    public function __construct(string $name, string $description = '') {
        $this->name = $name;
        $this->description = $description;
    }

    public function getIdTag(): int {
        return $this->id_tag;
    }

    public function getDescription(): string {
        return $this->description;
    }

    public function setDescription(string $description): void {
        $this->description = $description;
    }

    public function getName(): string {
        return $this->name;
    }

    public function setName(string $name): void {
        $this->name = $name;
    }
}

?>