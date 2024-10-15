<?php

namespace App\Controllers;

use App\Models\User;
use App\Models\Grade;
use App\Models\Teacher;
use App\Models\Subject;
use App\Models\Student;

class UsersController {
    private $db;
    private $user;  // Właściwość dla obiektu User
    private $subject;
    private $grades;

    public function __construct($db) {
        $this->db = $db;
        $this->user = new User($this->db);  // Tworzymy obiekt User
        $this->subject = new Subject($this->db);  // Tworzymy obiekt Przedmiot
        $this->grades = new Grade($this->db);
    }
    
    public function index() {
        $users = User::all();
        require_once __DIR__ . '/../Views/users.php';
    }

    // Akcja rejestracji
    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $login = $_POST['login'];
            $password = $_POST['password'];
            $permissions = $_POST['permissions'];  // Np. student/nauczyciel
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

            // Wywołujemy funkcję z modelu do utworzenia użytkownika
            if ($this->user->createUser($login, $password, $permissions, $firstName, $lastName)) {
                session_start();
                $_SESSION['success_message'] = 'Użytkownik został pomyślnie dodany. Możesz się teraz zalogować.';
                header("Location: /users/login");
                exit();
            } else {
                echo "Błąd podczas rejestracji.";
            }
        } else {
            // Wyświetlamy formularz rejestracji
            require_once __DIR__ . '/../Views/register.php';
        }
    }

    // Akcja logowania
    public function login() {
        session_start();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $login = $_POST['login'];
            $password = $_POST['password'];

            // Wywołujemy funkcję logowania z modelu
            $user = $this->user->login($login, $password);
            if ($user) {
                 // Sprawdzamy, czy użytkownik jest uczniem
                if ($user['permissions'] === 'student') {
                    // Tutaj można np. ustawić sesję użytkownika
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['name'] = $user['first_name'];
                    // Pobierz oceny ucznia
                    $gradesByStudent = $this->grades->getGradesByStudentId($user['id']);
                    
                    // Renderuj widok dla ucznia
                    require_once __DIR__ . '/../Views/student_dashboard.php';
                } else if ($user['permissions'] === 'admin') {
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['name'] = $user['login'];

                    header("Location: /users/admin");
                } else {
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['name'] = $user['login'];
                    $_SESSION['first_name'] = $user['first_name'];
                    // Nauczyciel
                    header("Location: /users/teacher"); 
                }
            } else {
                echo "Błędny login lub hasło.";
            }
        } else {
            // Wyświetlamy formularz logowania
            require_once __DIR__ . '/../Views/login.php';
        }
    }

    public function admin() {
        session_start();
        $subjects = $this->subject->getAllSubjects($this->db);
        $teachers = Teacher::getAllTeachers($this->db);

        require_once __DIR__ . '/../Views/admin_dashboard.php';
    }

    public function teacher() {
        session_start();
        $subjects = $this->subject->getAllSubjects($this->db);
        $students = Student::getAllStudents($this->db);
        foreach ($subjects as $subject) {
            if ($subject['teacher_id'] == $_SESSION['user_id']) {
                $logbook [$subject['name']] = $students; //dopisanie do przedmiotu uczniów 
            }
        }

        require_once __DIR__ . '/../Views/teacher_dashboard.php';
    }

    //Wyloguj
    public function logout() {
        session_start();
        $_SESSION = [];
        session_destroy();
        header("Location: /users/login");
        exit();
    }

}