<?php

namespace App\Models;

class Subject {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    // Pobierz wszystkie przedmioty
    public function getAllSubjects() {
        $stmt = $this->db->query("SELECT * FROM subjects");
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    // Pobierz jeden przedmiot
    public function getSubjectsById($id) {
        $stmt = $this->db->prepare("SELECT * FROM subjects WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    // Dodaj przedmiot
    public function addSubject($name) {
        $stmt = $this->db->prepare("INSERT INTO subjects (name) VALUES (:name)");
        $stmt->bindParam(':name', $name);
        return $stmt->execute();
    }

    // Zaktualizuj przedmiot
    public function updateSubject($id, $name) {
        $stmt = $this->db->prepare("UPDATE subjects SET name = :name WHERE id = :id");
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    // Usuń przedmiot
    public function deleteSubject($id) {
        $stmt = $this->db->prepare("DELETE FROM subjects WHERE id = :id");
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
