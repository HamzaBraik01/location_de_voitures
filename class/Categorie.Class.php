<?php
require_once 'DatabaseConnection.php';
$db = new Database();

class Categorie {
    private $id;
    private $nom;
    private $db;

    public function __construct($id = null, $nom) {
        $this->db = new Database(); 
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
        $db = new Database(); 
        $sql = "SELECT * FROM categorie";
        $stmt = $db->getConnection()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();

        
    }

    public static function getById($id) {
        
    }
    
}
?>