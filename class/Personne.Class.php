<?php
class Personne {
    private $id;
    private $nom;
    private $email;
    private $motDePasse;
    private $roleId;

    public function __construct($id = null, $nom, $email, $motDePasse, $roleId) {
        $this->id = $id;
        $this->nom = $nom;
        $this->email = $email;
        $this->motDePasse = $motDePasse;
        $this->roleId = $roleId;
    }

    public function getId() {
        return $this->id;
    }

    public function getNom() {
        return $this->nom;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getMotDePasse() {
        return $this->motDePasse;
    }

    public function getRoleId() {
        return $this->roleId;
    }

    public static function getByEmail($email) {
        // Code to fetch a person by email from the database
    }
}

?>