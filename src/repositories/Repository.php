<?php

require_once __DIR__."/../../Database.php";

class Repository {

    protected $database;

    public function __construct() {
        // Pobieramy jedno, współdzielone połączenie z bazy danych przez Singleton
        $this->database = Database::getInstance()->connect();
    }
}