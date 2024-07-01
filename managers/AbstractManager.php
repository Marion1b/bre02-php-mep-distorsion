<?php
/**
 * @author : Gaellan
 * @link : https://github.com/Gaellan
 */


abstract class AbstractManager
{
    protected PDO $db;

    public function __construct()
    {
        $dbInfo = $this->getDatabaseInfo();

        $connexion = "mysql:host=".$dbInfo["host"].";port=3306;charset=utf8;dbname=".$dbInfo["db_name"];
        $this->db = new PDO(
            $connexion,
            $dbInfo["user"],
            $dbInfo["password"]
        );
    }

    private function getDatabaseInfo() : void
    {
        require_once __DIR__ . '/vendor/autoload.php';
        $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
        $dotenv->load();
        $dbHost = $_ENV['DB_HOST'];
        $dbUser = $_ENV['DB_USER'];
        $dbPass = $_ENV['DB_PASS'];
        $dbName = $_ENV['DB_NAME'];
        try {
            $conn = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUser, $dbPass);
            // Définir le mode d'erreur PDO à exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "Connexion réussie";
            } catch(PDOException $e) {
            echo "Erreur de connexion : " . $e->getMessage();
        }
    }
}