<?php
class Comment {
    private int $id_comment;
    private string $content;
    private int $id_article;
    private int $id_user;

    public function __construct(string $content, int $id_article, int $id_user) {
        $this->content = $content;
        $this->id_article = $id_article;
        $this->id_user = $id_user;
    }

    public function getIdComment(): int {
        return $this->id_comment;
    }

    public function getContent(): string {
        return $this->content;
    }

    public function setContent(string $content): void {
        $this->content = $content;
    }

    public function getIdArticle(): int {
        return $this->id_article;
    }

    public function setIdArticle(int $id_article): void {
        $this->id_article = $id_article;
    }

    public function getIdUser(): int {
        return $this->id_user;
    }

    public function setIdUser(int $id_user): void {
        $this->id_user = $id_user;
    }
}

?>