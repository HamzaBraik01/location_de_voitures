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

    public function save(PDO $pdo): void {
        $stmt = $pdo->prepare("INSERT INTO Theme (name) VALUES (:name)");
        $stmt->execute(['name' => $this->name]);
    }

    public static function getAll(PDO $pdo): array {
        $stmt = $pdo->query("SELECT * FROM Theme");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function delete(PDO $pdo, int $id): void {
        $stmt = $pdo->prepare("DELETE FROM Theme WHERE id_theme = :id");
        $stmt->execute(['id' => $id]);
    }

    public static function update(PDO $pdo, int $id, string $name): void {
        $stmt = $pdo->prepare("UPDATE Theme SET name = :name WHERE id_theme = :id");
        $stmt->execute(['name' => $name, 'id' => $id]);
    }
}
?>