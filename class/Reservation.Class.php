<?php
require_once 'DatabaseConnection.php';
class Reservation {
    private $id;
    private $dateDebut;
    private $dateFin;
    private $lieuPriseEnCharge;
    private $clientId;
    private $vehiculeId;

    public function __construct($id = null, $dateDebut, $dateFin, $lieuPriseEnCharge, $clientId, $vehiculeId) {
        $this->id = $id;
        $this->dateDebut = $dateDebut;
        $this->dateFin = $dateFin;
        $this->lieuPriseEnCharge = $lieuPriseEnCharge;
        $this->clientId = $clientId;
        $this->vehiculeId = $vehiculeId;
    }

    public function getId() {
        return $this->id;
    }

    public function getDateDebut() {
        return $this->dateDebut;
    }

    public function getDateFin() {
        return $this->dateFin;
    }

    public function getLieuPriseEnCharge() {
        return $this->lieuPriseEnCharge;
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
    public static function createReservation($dateDebut, $dateFin, $lieuPriseEnCharge, $clientId, $vehiculeId) {
        $db = new Database();
        $conn = $db->getConnection();

        $stmt = $conn->prepare("INSERT INTO reservation (dateDebut, dateFin, lieuPriseEnCharge, clientId, vehiculeId, statut) VALUES (:dateDebut, :dateFin, :lieuPriseEnCharge, :clientId, :vehiculeId, 'en attente')");
        $stmt->execute([
            'dateDebut' => $dateDebut,
            'dateFin' => $dateFin,
            'lieuPriseEnCharge' => $lieuPriseEnCharge,
            'clientId' => $clientId,
            'vehiculeId' => $vehiculeId
        ]);

        return true; 
    }
            
}
?>