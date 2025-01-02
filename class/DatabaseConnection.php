<?php
class Database {
    private $host = 'localhost'; 
    private $dbName = 'LocationVoiture'; 
    private $username = 'root'; 
    private $password = ''; 
    private $pdo;

    
    public function __construct() {
        try {
            
            $this->pdo = new PDO("mysql:host={$this->host};dbname={$this->dbName}", $this->username, $this->password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
            $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC); 
        } catch (PDOException $e) {
            // Gestion des erreurs si la connexion échoue
            echo "Erreur de connexion à la base de données: " . $e->getMessage();
            exit;
        }
    }

    public function getConnection() {
        return $this->pdo;
    }

    public function testConnection() {
        try {
            $this->getConnection(); 
            echo "Connection successful!"; 
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage(); 
        }
    }
}
/*$db = new Database();
$db->testConnection();*/
?>