<?php

// Wczytanie autoloadera
require_once __DIR__ . '/../app/Core/Autoloader.php';

// Załaduj połączenie z bazą danych
$db = require __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../config/helpers.php';

// Rejestracja autoloadera
App\Core\Autoloader::register();

// Uruchomienie routera (możemy teraz używać przestrzeni nazw bez potrzeby ręcznego include'owania plików)
use App\Core\Router;

$router = new Router();
$router->dispatch($_SERVER['REQUEST_URI'], $db);
