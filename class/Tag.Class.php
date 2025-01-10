<?php
class Tag {
    private int $id_tag;
    private string $description;
    private string $name;

    public function __construct(string $name, string $description = '') {
        $this->name = $name;
        $this->description = $description;
    }

    public static function getAll($pdo) {
        $stmt = $pdo->query("SELECT * FROM Tag");
        return $stmt->fetchAll();
    }

    public static function create($pdo, $name, $description = '') {
        $stmt = $pdo->prepare("INSERT INTO Tag (name, description) VALUES (:name, :description)");
        $stmt->execute(['name' => $name, 'description' => $description]);
        return $pdo->lastInsertId();
    }

    public static function getByName($pdo, $name) {
        $stmt = $pdo->prepare("SELECT * FROM Tag WHERE name = :name");
        $stmt->execute(['name' => $name]);
        return $stmt->fetch();
    }
}
?>