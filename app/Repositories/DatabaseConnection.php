<?php

namespace app\Repositories;

use PDO;
use PDOException;

class Database{
    private static ?PDO $instance = null;
    private function __construct() {}
    public static function getInstance(): PDO{
        if (Database::$instance === null) {
            $host = 'localhost';
            $db   = 'library_managment';
            $user = 'root';
            $pass = '';
            try {
                Database::$instance = new PDO("mysql:host=$host;dbname=$db;charset='utf8mb4'", $user, $pass);
            } catch (PDOException $e) {
                die("Erreur de connexion à la base de données : " . $e->getMessage());
            }
        }

        return Database::$instance;
    }
}
