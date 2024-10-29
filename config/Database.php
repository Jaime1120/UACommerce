<?php

require_once 'envLoader.php';  // Asegúrate de que la ruta sea correcta

class Database {
    private $host;
    private $port;
    private $dbname;
    private $username;
    private $password;
    private $pdo;

    public function __construct() {
        // Cargar las variables desde el archivo .env
        loadEnv(__DIR__ . '/../Recursos/.env');  // Ajusta la ruta según sea necesario

        // Asignar las variables a las propiedades de la clase
        $this->host = $_ENV['DB_HOST'] ?? '127.0.0.1';
        $this->port = $_ENV['DB_PORT'] ?? '3306';
        $this->dbname = $_ENV['DB_DATABASE'] ?? 'test';
        $this->username = $_ENV['DB_USERNAME'] ?? 'root';
        $this->password = $_ENV['DB_PASSWORD'] ?? '';
    }

    // Método para obtener la conexión PDO
    public function getConnection() {
        if ($this->pdo === null) {
            try {
                $dsn = "mysql:host={$this->host};port={$this->port};dbname={$this->dbname};charset=utf8";
                $this->pdo = new PDO($dsn, $this->username, $this->password);
                $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die("Error en la conexión: " . $e->getMessage());
            }
        }
        return $this->pdo;
    }
}
