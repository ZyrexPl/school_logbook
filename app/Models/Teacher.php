<?php

namespace App\Models;

class Teacher {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    // Pobierz wszystkich nauczycieli
    public static function getAllTeachers($db) {
        $stmt = $db->query("SELECT * FROM users WHERE permissions = 'teacher'");
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    // Dodaj nauczyciela
    public function addTeacher($login, $password, $firstName, $lastName) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $this->db->prepare("INSERT INTO users (login, password, permissions, first_name, last_name) VALUES (:login, :password, 'teacher', :first_name, :last_name)");
        $stmt->bindParam(':login', $login);
        $stmt->bindParam(':password', $hashedPassword); 
        $stmt->bindParam(':first_name', $firstName, \PDO::PARAM_STR);
        $stmt->bindParam(':last_name', $lastName, \PDO::PARAM_STR);
        return $stmt->execute();
    }

    // Zaktualizuj nauczyciela
    public function updateTeacher($id, $login) {
        $stmt = $this->db->prepare("UPDATE users SET login = :login WHERE id = :id AND permissions = 'teacher'");
        $stmt->bindParam(':login', $login);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    // Usuń nauczyciela
    public function deleteTeacher($id) {
        $stmt = $this->db->prepare("DELETE FROM users WHERE id = :id AND permissions = 'teacher'");
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    // Przypisz nauczyciela do przedmiotu
    public function assignTeacherToSubject($teacherId, $subjectId) {
        $stmt = $this->db->prepare("UPDATE subjects SET teacher_id = :teacherId WHERE id = :subjectId");
        $stmt->bindParam(':teacherId', $teacherId);
        $stmt->bindParam(':subjectId', $subjectId);
        return $stmt->execute();
    }
}
