<?php

namespace App\Models;

class User {
    private $db;

    // Konstruktor, który przyjmuje obiekt PDO (połączenie z bazą danych)
    public function __construct($db) {
        $this->db = $db;
    }

    // Przykładowa funkcja pobierająca użytkownika po ID
    public function getUserById($id) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    // Funkcja do tworzenia nowego użytkownika (rejestracja)
    public function createUser($login, $password, $permissions, $firstName, $lastName) {
        // Hashowanie hasła
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Wstawianie użytkownika do bazy danych
        $stmt = $this->db->prepare('INSERT INTO users (login, password, permissions, first_name, last_name) VALUES (:login, :password, :permissions, :first_name, :last_name)');
        $stmt->bindParam(':login', $login, \PDO::PARAM_STR);
        $stmt->bindParam(':password', $hashedPassword, \PDO::PARAM_STR);
        $stmt->bindParam(':permissions', $permissions, \PDO::PARAM_STR);
        $stmt->bindParam(':first_name', $firstName, \PDO::PARAM_STR);
        $stmt->bindParam(':last_name', $lastName, \PDO::PARAM_STR);

        return $stmt->execute();
    }

    // Funkcja do logowania użytkownika
    public function login($login, $password) {
        // Pobieramy użytkownika na podstawie loginu
        $stmt = $this->db->prepare('SELECT * FROM users WHERE login = :login');
        $stmt->bindValue(':login', $login);
        $stmt->execute();
        
        $user = $stmt->fetch();

        // Sprawdzamy, czy użytkownik istnieje i czy hasło jest poprawne
        if ($user && password_verify($password, $user['password'])) {
            // Zwracamy dane użytkownika po udanym logowaniu
            return $user;
        } else {
            // Zwracamy false, jeśli login lub hasło są nieprawidłowe
            return false;
        }
    }

    // Funkcja do aktualizacji hasła użytkownika
    public function updatePassword($userId, $newPassword) {
        // Hashowanie nowego hasła
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        // Aktualizacja w bazie danych
        $stmt = $this->db->prepare('UPDATE users SET password = :password WHERE id = :id');
        $stmt->bindValue(':password', $hashedPassword);
        $stmt->bindValue(':id', $userId);
        return $stmt->execute();
    }

}