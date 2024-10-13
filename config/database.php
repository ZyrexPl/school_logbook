<?php

// Konfiguracja połączenia z bazą danych
$host = 'localhost';        // Adres serwera bazy danych
$dbname = 'school_logbook';   
$username = 'root';    
$password = '';  

try {
    // Utwórz nowy obiekt PDO i nawiąż połączenie z bazą danych
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);

    // Ustaw tryb zgłaszania błędów na wyjątki, aby można było je łatwo obsłużyć
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    // Jeśli wystąpi błąd, przechwyć go i wyświetl wiadomość
    die("Błąd połączenia z bazą danych: " . $e->getMessage());
}

// Zwracaj obiekt PDO, aby inne pliki mogły korzystać z połączenia
return $pdo;
