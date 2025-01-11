<?php
class ArticleTag {
    private int $id_tag;
    private int $id_article;

    public function __construct(int $id_tag, int $id_article) {
        $this->id_tag = $id_tag;
        $this->id_article = $id_article;
    }

    public function getIdTag(): int {
        return $this->id_tag;
    }

    public function getIdArticle(): int {
        return $this->id_article;
    }

    public static function addTagToArticle(PDO $pdo, int $id_article, int $id_tag): void {
        $stmt = $pdo->prepare("INSERT INTO Article_Tag (id_tag, id_article) VALUES (:id_tag, :id_article)");
        $stmt->execute(['id_tag' => $id_tag, 'id_article' => $id_article]);
    }

    public static function getTagsByArticle(PDO $pdo, int $id_article): array {
        $stmt = $pdo->prepare("SELECT Tag.* FROM Tag JOIN Article_Tag ON Tag.id_tag = Article_Tag.id_tag WHERE Article_Tag.id_article = :id_article");
        $stmt->execute(['id_article' => $id_article]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>