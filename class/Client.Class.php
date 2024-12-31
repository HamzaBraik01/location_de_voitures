<?php
class Client extends Personne {
    public function __construct($id, $nom, $email, $motDePasse, $roleId) {
        parent::__construct($id, $nom, $email, $motDePasse, $roleId);
    }

    // Additional methods specific to Client can be added here
}
?>