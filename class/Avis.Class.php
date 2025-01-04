<?php
require_once 'DatabaseConnection.php';
class Avis {
    private $id;
    private $commentaire;
    private $note;
    private $clientId;
    private $vehiculeId;
    private $db;


    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    public function getId() {
        return $this->id;
    }

    public function getCommentaire() {
        return $this->commentaire;
    }

    public function getNote() {
        return $this->note;
    }

    public function getClientId() {
        return $this->clientId;
    }

    public function getVehiculeId() {
        return $this->vehiculeId;
    }

    public static function getByClientId($clientId) {
        
    }

    public static function getByVehiculeId($vehiculeId) {
    }
    public function getAllAvis() {
        try {
            $query = "SELECT a.*, p.nom as client_nom, v.modele as vehicule_modele, v.image as vehicule_image 
                        FROM avis a 
                        JOIN personne p ON a.clientId = p.id 
                        JOIN reservation r ON a.reservationId = r.id 
                        JOIN vehicule v ON r.vehiculeId = v.id";
            $stmt = $this->db->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            return [];
        }
    }
    public function deleteAvis($id) {
        try {
            $query = "DELETE FROM avis WHERE id = ?";
            $stmt = $this->db->prepare($query);
            return $stmt->execute([$id]);
        } catch (PDOException $e) {
            return false;
        }
    }
}
?>