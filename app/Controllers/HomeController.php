<?php

namespace App\Controllers;

class HomeController {
    
    // Akcja wyświetlająca stronę główną
    public function index() {
        require_once __DIR__ . '/../Views/home.php';
    }
}
