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
}

?>