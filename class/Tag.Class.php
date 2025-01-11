<?php
class Tag {
    private int $id_tag;
    private string $name;
    private string $description;

    public function __construct(string $name, string $description = '') {
        $this->name = $name;
        $this->description = $description;
    }

    public function getIdTag(): int {
        return $this->id_tag;
    }

    public function getName(): string {
        return $this->name;
    }

    public function getDescription(): string {
        return $this->description;
    }

    public static function create(PDO $pdo, string $name, string $description = ''): int {
        $stmt = $pdo->prepare("INSERT INTO Tag (name, description) VALUES (:name, :description)");
        $stmt->execute(['name' => $name, 'description' => $description]);
        return $pdo->lastInsertId();
    }

    public static function getByName(PDO $pdo, string $name): ?array {
        $stmt = $pdo->prepare("SELECT * FROM Tag WHERE name = :name");
        $stmt->execute(['name' => $name]);
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    public static function getAll(PDO $pdo): array {
        $stmt = $pdo->query("SELECT * FROM Tag");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>