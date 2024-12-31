<?php
class Vehicule {
    private $id;
    private $modele;
    private $prixParJour;
    private $disponibilite;
    private $categorieId;

    public function __construct($id = null, $modele, $prixParJour, $disponibilite, $categorieId) {
        $this->id = $id;
        $this->modele = $modele;
        $this->prixParJour = $prixParJour;
        $this->disponibilite = $disponibilite;
        $this->categorieId = $categorieId;
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

    public static function getAll() {
        // Code to fetch all vehicles from the database
    }

    public static function getById($id) {
        // Code to fetch a vehicle by id from the database
    }
}
?>