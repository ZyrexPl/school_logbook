<?php

namespace App\Controllers;

use App\Models\User;
use App\Models\Grade;
use App\Models\Teacher;
use App\Models\Subject;

class GradesController {

    private $db;
    private $grade;
    private $user;
    private $subject;

    public function __construct($db) {
        $this->db = $db;
        $this->grade = new Grade($this->db);
        $this->user = new User($this->db);  // Tworzymy obiekt User
        $this->subject = new Subject($this->db);  // Tworzymy obiekt Przedmiot
    }

    public function add($student_id, $subject_id) {
        $subject = $this->subject->getSubjectsById($subject_id);
        $student = $this->user->getUserById($student_id);
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            //Pobieramy z formularza ocenę
            $grade = $_POST['grade'];

            $this->grade->addGrade($student_id, $subject_id, $grade);

            header("Location: /users/teacher");
            exit();
        } else {
            // Wyświetlenie formularza dodawania nauczyciela
            require_once __DIR__ . '/../Views/add_grade.php';
        }
    }
}