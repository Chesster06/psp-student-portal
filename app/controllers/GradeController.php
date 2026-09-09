<?php

require_once __DIR__ . '/../models/Student.php';

class GradeController {
    private $studentModel;

    public function __construct() {
        $this->studentModel = new Student();
    }

    public function index() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (empty($_SESSION['student_nric'])) {
            header('Location: index.php?page=login');
            exit;
        }

        $role = $_SESSION['user_role'] ?? 'student';
        if ($role === 'lecturer') {
            $grades = $this->studentModel->getAllGrades();
        } else {
            $studentGrade = $this->studentModel->getGradeByIc($_SESSION['student_nric']);
            $grades = $studentGrade ? [$studentGrade] : [];
        }

        include __DIR__ . '/../views/grades/index.php';
    }

    public function create() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (empty($_SESSION['student_nric']) || ($_SESSION['user_role'] ?? '') !== 'lecturer') {
            header('Location: index.php?page=grades');
            exit;
        }
        include __DIR__ . '/../views/grades/create.php';
    }

    public function edit() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (empty($_SESSION['student_nric']) || ($_SESSION['user_role'] ?? '') !== 'lecturer') {
            header('Location: index.php?page=grades');
            exit;
        }

        $id = $_GET['id'] ?? null;
        $record = $id ? $this->studentModel->getGradeById($id) : null;
        if (!$record) {
            header('Location: index.php?page=grades');
            exit;
        }

        include __DIR__ . '/../views/grades/edit.php';
    }

    public function store() {
    }

    public function update() {
    }

    public function delete() {
    }
}
