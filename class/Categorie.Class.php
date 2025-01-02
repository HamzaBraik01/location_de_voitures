<?php
class Categorie {
    private $id;
    private $nom;

    public function __construct($id = null, $nom) {
        $this->id = $id;
        $this->nom = $nom;
    }

    public function getId() {
        return $this->id;
    }

    public function getNom() {
        return $this->nom;
    }

    public static function getAll() {
        
    }

    public static function getById($id) {
        
    }
}
?>