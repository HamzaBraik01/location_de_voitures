<?php
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
        // Code to fetch reservations by client ID
    }

    public static function getByVehiculeId($vehiculeId) {
        // Code to fetch reservations by vehicle ID
    }
}
?>