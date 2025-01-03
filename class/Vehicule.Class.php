<?php
require_once 'DatabaseConnection.php';
$db = new Database();
class Vehicule {
    private $id;
    private $modele;
    private $prixParJour;
    private $disponibilite;
    private $categorieId;
    private $image; 
    private $db;

    public function __construct($id = null, $modele, $prixParJour, $disponibilite, $categorieId,$image = null) {
        $this->id = $id;
        $this->modele = $modele;
        $this->prixParJour = $prixParJour;
        $this->disponibilite = $disponibilite;
        $this->categorieId = $categorieId;
        $this->db = new Database(); 
    }

    public function getId() {
        return $this->id;
    }

    public function getModele() {
        return $this->modele;
    }

    public function getPrixParJour() {
        return $this->prixParJour;
    }

    public function isDisponible() {
        return $this->disponibilite;
    }

    public function getCategorieId() {
        return $this->categorieId;
    }
    public function getImage() {
        return $this->image; 
    }

    public static function getAll() {
        
    }

    public static function getById($id) {
        
    }
    public static function getByCategory($categoryId) {
        $db = new Database();
        $conn = $db->getConnection();
        $sql = "SELECT * FROM vehicule WHERE categorieId = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$categoryId]);
        return $stmt->fetchAll();
    }
}
?>