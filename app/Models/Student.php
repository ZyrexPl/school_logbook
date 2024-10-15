<?php

namespace App\Models;

class Student {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    // Pobierz wszystkich
    public static function getAllStudents($db) {
        $stmt = $db->query("SELECT id, first_name, last_name FROM users WHERE permissions = 'student'");
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}