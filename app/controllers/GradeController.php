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

    // 1. LENGKAPKAN STORE (Tambah Gred Baru)
    public function store() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (empty($_SESSION['student_nric']) || ($_SESSION['user_role'] ?? '') !== 'lecturer') {
            header('Location: index.php?page=grades');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'] ?? '';
            $ic = $_POST['ic'] ?? '';
            $marks = $_POST['marks'] ?? 0;

            if (!empty($name) && !empty($ic)) {
                $this->studentModel->createGrade($name, $ic, $marks);
                $_SESSION['success'] = "Rekod gred berjaya ditambah!";
            } else {
                $_SESSION['error'] = "Sila lengkapkan maklumat!";
            }
        }
        header('Location: index.php?page=grades');
        exit;
    }

    // 2. LENGKAPKAN UPDATE (Kemaskini Gred)
    public function update() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (empty($_SESSION['student_nric']) || ($_SESSION['user_role'] ?? '') !== 'lecturer') {
            header('Location: index.php?page=grades');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'] ?? null;
            $name = $_POST['name'] ?? '';
            $ic = $_POST['ic'] ?? '';
            $marks = $_POST['marks'] ?? 0;

            if ($id) {
                $this->studentModel->updateGrade($id, $name, $ic, $marks);
                $_SESSION['success'] = "Rekod gred berjaya dikemaskini!";
            }
        }
        header('Location: index.php?page=grades');
        exit;
    }

    // 3. LENGKAPKAN DELETE (Padam Gred)
    public function delete() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (empty($_SESSION['student_nric']) || ($_SESSION['user_role'] ?? '') !== 'lecturer') {
            header('Location: index.php?page=grades');
            exit;
        }

        $id = $_GET['id'] ?? null;
        if ($id) {
            $this->studentModel->deleteGrade($id);
            $_SESSION['success'] = "Rekod gred berjaya dipadam!";
        }
        header('Location: index.php?page=grades');
        exit;
    }
}