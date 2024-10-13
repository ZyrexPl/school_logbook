<?php

namespace App\Controllers;

use App\Models\User;
use App\Models\Grade;
use App\Models\Teacher;
use App\Models\Subject;

class TeachersController {
    private $db;
    private $user;

    public function __construct($db) {
        $this->db = $db;
        $this->teacher = new Teacher($this->db);  // Tworzymy obiekt Nauczyciela
    }

    public function add() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $login = $_POST['login'];
            $password = $_POST['password'];
            $firstName = $_POST['first_name'];
            $lastName = $_POST['last_name'];

            // Walidacja danych 
            if (empty($login) || empty($password)) {
                echo "Login i hasło nie mogą być puste!";
                return;
            }
            //Użycie wyrażenia regularnego - sprawdzamy czy wprowadzone znaki są literami i cyframi
            $result = preg_match('/^[a-zA-Z0-9]+$/', $login);
            if ($result !=1) {
                echo "Login może zawierać tylko litery i cyfry.";
                return;
            }

            // Zapis nauczyciela w bazie danych poprzez model Teacher

            $this->teacher->addTeacher($login, $password, $firstName, $lastName);

            // Po dodaniu nauczyciela przekierowanie do panelu administratora
            header("Location: /users/admin");
            exit();
        } else {
            // Wyświetlenie formularza dodawania nauczyciela
            require_once __DIR__ . '/../Views/register_teacher.php';
        }
    }
}