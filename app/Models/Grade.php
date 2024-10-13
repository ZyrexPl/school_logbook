<?php

namespace App\Models;

class Grade {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    // Pobierz oceny dla ucznia na podstawie jego ID
    public function getGradesByStudentId($studentId) {
        $stmt = $this->db->prepare("
            SELECT subjects.name AS subject, grades.grade 
            FROM grades 
            JOIN subjects ON grades.subject_id = subjects.id 
            WHERE grades.student_id = :studentId
        ");
        $stmt->bindParam(':studentId', $studentId);
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC); //Kiedy używamy \PDO::FETCH_ASSOC, PDO zwraca wyniki zapytania w postaci tablicy asocjacyjnej, czyli takiej, gdzie kluczami są nazwy kolumn, a wartościami — odpowiadające im dane.
    }
}
