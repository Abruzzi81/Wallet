<?php
// .env 
require_once "config.php";

// singleton 
class Database {
    // 1. Statyczne pole przechowujące jedyną instancję tej klasy
    private static $instance = null;
    private $conn;

    private $username;
    private $password;
    private $host;
    private $database;

    // 2. konstruktor PRYWATNY
    private function __construct()
    {
        $this->username = USERNAME;
        $this->password = PASSWORD;
        $this->host = HOST;
        $this->database = DATABASE;

        // Łączymy się od razu podczas tworzenia tej jednej instancji
        try {
            $this->conn = new PDO(
                "pgsql:host=$this->host;port=5432;dbname=$this->database",
                $this->username,
                $this->password
            );

            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // Warto dodać domyślne zwracanie jako tablice asocjacyjne:
            $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        }
        catch(PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    // 3. Statyczna metoda do pobierania połączenia
    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    // Zwraca gotowy obiekt PDO do robienia zapytań
    public function connect()
    {
        return $this->conn;
    }

    // Blokujemy też klonowanie obiektu, żeby nikt go nie popsuł
    private function __clone() {}
}