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
    public static function getPaginatedVehicles($page = 1, $perPage = 3) {
        $db = new Database();
        $conn = $db->getConnection();

        $offset = ($page - 1) * $perPage;

        $sql = "SELECT * FROM vehicule LIMIT :perPage OFFSET :offset";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':perPage', $perPage, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    public static function getTotalVehicles() {
        $db = new Database();
        $conn = $db->getConnection();

        $sql = "SELECT COUNT(*) as total FROM vehicule";
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        return $stmt->fetch()['total'];
    }
    public static function updateDisponibilite($id, $disponibilite) {
        $db = new Database();
        $conn = $db->getConnection();
    
        $sql = "UPDATE vehicule SET disponibilite = :disponibilite WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            'disponibilite' => $disponibilite ? 1 : 0, 
            'id' => $id
        ]);
    
        return true; 
    }
}
?>