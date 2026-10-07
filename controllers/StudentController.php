<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/Student.php';

class StudentController {
    private $studentModel;

    public function __construct() {
        global $pdo;
        if (session_status() === PHP_SESSION_NONE) session_start();
        if (!isset($_SESSION['user_id'])) {
            header("Location: index.php?page=login");
            exit;
        }
        $this->studentModel = new Student($pdo);
    }

    public function index() {
        $students = $this->studentModel->getAll();
        require __DIR__ . '/../views/students/index.php';
    }

    public function create() {
        $errors = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name'] ?? '');
            $ic = trim($_POST['ic'] ?? '');
            $marks = trim($_POST['marks'] ?? '');

            if (empty($name)) $errors[] = "Name is required.";
            if (empty($ic)) $errors[] = "IC is required.";
            if (!is_numeric($marks) || $marks < 0 || $marks > 100)
                $errors[] = "Marks must be a number between 0 and 100.";

            if (empty($errors)) {
                $this->studentModel->create($name, $ic, $marks);
                header("Location: index.php?page=students&msg=created");
                exit;
            }
        }
        require __DIR__ . '/../views/students/create.php';
    }

    public function edit() {
        $id = $_GET['id'] ?? 0;
        $student = $this->studentModel->getById($id);
        if (!$student) { header("Location: index.php?page=students"); exit; }

        $errors = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name'] ?? '');
            $ic = trim($_POST['ic'] ?? '');
            $marks = trim($_POST['marks'] ?? '');

            if (empty($name)) $errors[] = "Name is required.";
            if (empty($ic)) $errors[] = "IC is required.";
            if (!is_numeric($marks) || $marks < 0 || $marks > 100)
                $errors[] = "Marks must be a number between 0 and 100.";

            if (empty($errors)) {
                $this->studentModel->update($id, $name, $ic, $marks);
                header("Location: index.php?page=students&msg=updated");
                exit;
            }
        }
        require __DIR__ . '/../views/students/edit.php';
    }

    public function delete() {
        $id = $_GET['id'] ?? 0;
        $this->studentModel->delete($id);
        header("Location: index.php?page=students&msg=deleted");
        exit;
    }
}
?>