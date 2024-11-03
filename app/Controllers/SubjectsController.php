<?php

namespace App\Controllers;

use App\Models\User;
use App\Models\Grade;
use App\Models\Teacher;
use App\Models\Subject;

class SubjectsController {
    private $db;
    private $user;
    private $teacher;

    public function __construct($db) {
        $this->db = $db;
        $this->subject = new Subject($this->db);  // Tworzymy obiekt przedmiotu
        $this->teacher = new Teacher($this->db);  // Tworzymy obiekt Nauczyciela
    }

    public function add() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];

            // Walidacja danych (można dodać więcej walidacji)
            if (empty($name)) {
                echo "Nazwa nie może być puste!";
                return;
            }

            // Zapis przedmiotu

            $this->subject->addSubject($name);

            // Po dodaniu przedmiotu przekierowanie do panelu administratora
            header("Location: /users/admin");
            exit();
        } else {
            // Wyświetlenie formularza dodawania przedmiotu
            require_once __DIR__ . '/../Views/add_subject.php';
        }
    }

    public function assign($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $teacherId = $_POST['teacher_id'];
            $this->teacher->assignTeacherToSubject($teacherId, $id);
            header("Location: /users/admin");
            exit();
        } else {
            $subject = $this->subject->getSubjectsById($id);
            $teachers = $teachers = Teacher::getAllTeachers($this->db);
            //Formularz przypisania nauczyciela do przedmiotu
            require_once __DIR__ . '/../Views/assign.php';
        }
    }
}