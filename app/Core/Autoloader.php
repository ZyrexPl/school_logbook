<?php

namespace App\Core;

class Autoloader {
    public static function register() {
        spl_autoload_register([__CLASS__, 'autoload']);
    }

    public static function autoload($class) {
        // Zamień namespace na ścieżkę
        $class = str_replace('App\\', '', $class); // Usuwa 'App\' z początku nazwy klasy
        $class = str_replace('\\', '/', $class);   // Zamienia backslash na slash

        // Zbuduj pełną ścieżkę do pliku
        $file = __DIR__ . '/../' . $class . '.php';

        // Jeśli plik istnieje, dołącz go
        if (file_exists($file)) {
            require_once $file;
        }
    }
}
