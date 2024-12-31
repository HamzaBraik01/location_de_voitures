<?php
class Administrateur extends Personne {
    public function __construct($id, $nom, $email, $motDePasse, $roleId) {
        parent::__construct($id, $nom, $email, $motDePasse, $roleId);
    }

}
?>
