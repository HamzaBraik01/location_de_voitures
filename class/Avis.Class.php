<?php

class Avis {
    private $id;
    private $commentaire;
    private $note;
    private $clientId;
    private $vehiculeId;

    public function __construct($id = null, $commentaire, $note, $clientId, $vehiculeId) {
        $this->id = $id;
        $this->commentaire = $commentaire;
        $this->note = $note;
        $this->clientId = $clientId;
        $this->vehiculeId = $vehiculeId;
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
        // Code to fetch reviews by client ID
    }

    public static function getByVehiculeId($vehiculeId) {
        // Code to fetch reviews by vehicle ID
    }
}
?>