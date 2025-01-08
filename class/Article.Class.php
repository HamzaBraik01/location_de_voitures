<?php
class Article {
    private int $id_article;
    private string $name;
    private string $content;
    private int $id_theme;
    private int $id_user;
    private string $status; // 'pending', 'confirmed', 'canceled'

    public function __construct(string $name, string $content, int $id_theme, int $id_user, string $status = 'pending') {
        $this->name = $name;
        $this->content = $content;
        $this->id_theme = $id_theme;
        $this->id_user = $id_user;
        $this->status = $status;
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
}

?>