<?php

class AppController {
    
    protected function isGet(): bool
    {
        return $_SERVER["REQUEST_METHOD"] === 'GET';
    }

    protected function isPost(): bool
    {
        return $_SERVER["REQUEST_METHOD"] === 'POST';
    }
 
    protected function render(string $template = null, array $variables = [])
    {
        // 1. Budujemy poprawne ścieżki do plików .html
        $templatePath = __DIR__ . '/../../public/views/'. $template.'.html';
        $templatePath404 = __DIR__ . '/../../public/views/404.html';
        $output = "";
                 
        // 2. Sprawdzamy czy plik widoku istnieje i ładujemy go w czystej postaci
        if(file_exists($templatePath)){
            ob_start();
            include $templatePath;
            $output = ob_get_clean();
        } else {
            ob_start();
            include $templatePath404;
            $output = ob_get_clean();
        }

        echo $output;
    }

    protected function requireLogin()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (empty($_SESSION['user_id'])) {
            $url = "http://$_SERVER[HTTP_HOST]";
            header("Location: {$url}/login");
            exit();
        }
    }
}