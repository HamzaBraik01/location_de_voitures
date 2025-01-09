<?php
class Article {
    private int $id_article;
    private string $name;
    private string $content;
    private int $id_theme;
    private int $id_user;
    private string $status;
    private ?string $image;

    public function __construct(
        string $name,
        string $content,
        int $id_theme,
        int $id_user,
        string $status = 'pending',
        ?string $image = null
    ) {
        $this->name = $name;
        $this->content = $content;
        $this->id_theme = $id_theme;
        $this->id_user = $id_user;
        $this->status = $status;
        $this->image = $image;
    }

    public function getIdArticle(): int {
        return $this->id_article;
    }

    public function getName(): string {
        return $this->name;
    }

    public function setName(string $name): void {
        $this->name = $name;
    }

    public function getContent(): string {
        return $this->content;
    }

    public function setContent(string $content): void {
        $this->content = $content;
    }

    public function getIdTheme(): int {
        return $this->id_theme;
    }

    public function setIdTheme(int $id_theme): void {
        $this->id_theme = $id_theme;
    }

    public function getIdUser(): int {
        return $this->id_user;
    }

    public function setIdUser(int $id_user): void {
        $this->id_user = $id_user;
    }

    public function getStatus(): string {
        return $this->status;
    }

    public function setStatus(string $status): void {
        $this->status = $status;
    }

    public function getImage(): ?string {
        return $this->image;
    }

    public function setImage(?string $image): void {
        $this->image = $image;
    }

    public function save(PDO $pdo): void {
        $stmt = $pdo->prepare("INSERT INTO Article (name, content, id_theme, id_user, status, image) VALUES (:name, :content, :id_theme, :id_user, :status, :image)");
        $stmt->execute([
            'name' => $this->name,
            'content' => $this->content,
            'id_theme' => $this->id_theme,
            'id_user' => $this->id_user,
            'status' => $this->status,
            'image' => $this->image
        ]);
    }

    public static function getAll(PDO $pdo): array {
        $stmt = $pdo->query("SELECT * FROM Article");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function delete(PDO $pdo, int $id): void {
        $stmt = $pdo->prepare("DELETE FROM Article WHERE id_article = :id");
        $stmt->execute(['id' => $id]);
    }

    public static function update(PDO $pdo, int $id, string $name, string $content, int $id_theme, int $id_user, string $status, ?string $image): void {
        $stmt = $pdo->prepare("UPDATE Article SET name = :name, content = :content, id_theme = :id_theme, id_user = :id_user, status = :status, image = :image WHERE id_article = :id");
        $stmt->execute([
            'name' => $name,
            'content' => $content,
            'id_theme' => $id_theme,
            'id_user' => $id_user,
            'status' => $status,
            'image' => $image,
            'id' => $id
        ]);
    }
    public static function getAllByTheme(PDO $pdo, int $id_theme): array {
        $stmt = $pdo->prepare("SELECT * FROM Article WHERE id_theme = :id_theme");
        $stmt->execute(['id_theme' => $id_theme]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>