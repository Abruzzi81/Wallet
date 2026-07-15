<?php

// Rejestrujemy tylko dwa podstawowe kontrolery na start
require_once 'src/controllers/DashboardController.php';

class Routing
{
    // Podstawowa konfiguracja ścieżek bazowych
    public static $routes = [
        "" => [
            "controller" => "DashboardController",
            "action" => "index"
        ],
        "dashboard" => [
            "controller" => "DashboardController",
            "action" => "index"
        ]
    ];

    // SINGLETON - Tablica przechowująca już utworzone instancje kontrolerów
    private static $instances = [];

    // Metoda pomocnicza pobierająca istniejącą instancję lub tworząca nową
    private static function getControllerInstance(string $className)
    {
        if (!array_key_exists($className, self::$instances)) {
            self::$instances[$className] = new $className();
        }
        return self::$instances[$className];
    }

    public static function run(string $path)
    {
        // Sprawdzamy, czy wpisany adres URL istnieje w naszej podstawowej tablicy $routes
        if (array_key_exists($path, self::$routes)) {
            $controllerName = self::$routes[$path]["controller"];
            $action = self::$routes[$path]["action"];
        } else {
            // Jeśli ścieżka nie istnieje, serwujemy podstawowy widok 404
            http_response_code(404);
            include 'public/views/404.html';
            return;
        }

        // Pobieramy kontroler przez mechanizm Singletona
        $controllerObj = self::getControllerInstance($controllerName);

        // Uruchamiamy akcję kontrolera (odpowiedzialną za wyrenderowanie jednego widoku)
        $controllerObj->$action();
    }
}