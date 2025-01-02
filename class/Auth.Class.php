<?php
require_once 'DatabaseConnection.php';

class Auth {
    private $pdo;

    public function __construct() {
        $db = new Database();
        $this->pdo = $db->getConnection();
    }

    public function login($email, $motDePasse) {
        $sql = "SELECT * FROM Personne WHERE email = :email LIMIT 1";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            if (password_verify($motDePasse, $user['motDePasse'])) {
                session_start();
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_email'] = $user['email'];
                $_SESSION['user_role'] = $user['roleId']; 

                if ($user['roleId'] == 1) {
                    header('Location: ../pages/dashboardAdmin.php');
                    exit();
                } elseif ($user['roleId'] == 2) {
                    /*header('Location: dashboardClient.php');*/
                    exit();
                }
                return true;
            } else {
                return false; 
            }
        } else {
            return false; 
        }
    }

    // Méthode pour vérifier si l'utilisateur est connecté
    public function isLoggedIn() {
        session_start();
        return isset($_SESSION['user_id']);
    }

    public function getUser() {
        session_start();
        if ($this->isLoggedIn()) {
            $userId = $_SESSION['user_id'];
            $sql = "SELECT * FROM Personne WHERE id = :id LIMIT 1";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':id', $userId);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
        return null;
    }

    public function logout() {
        session_start();
        session_unset();
        session_destroy();
    }

    public function register($nom, $email, $motDePasse) {
        $hashedPassword = password_hash($motDePasse, PASSWORD_DEFAULT);

        $sql = "SELECT * FROM Personne WHERE email = :email LIMIT 1";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return false; 
        }

        $roleId = 2; // Par défaut, rôle Client

        $sql = "INSERT INTO Personne (nom, email, motDePasse, roleId) VALUES (:nom, :email, :motDePasse, :roleId)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':motDePasse', $hashedPassword);
        $stmt->bindParam(':roleId', $roleId);
        return $stmt->execute();
    }
}
?>
