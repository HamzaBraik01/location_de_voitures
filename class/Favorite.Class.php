<?php
class Favorite {
    private int $id_article;
    private int $id_user;

    public function __construct(int $id_article, int $id_user) {
        $this->id_article = $id_article;
        $this->id_user = $id_user;
    }

    public function getIdArticle(): int {
        return $this->id_article;
    }

    public function getIdUser(): int {
        return $this->id_user;
    }
}

?>