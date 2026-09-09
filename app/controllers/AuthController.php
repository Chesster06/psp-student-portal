<?php

require_once __DIR__ . '/../models/Student.php';

class AuthController {
    private $studentModel;

    public function __construct() {
        $this->studentModel = new Student();
    }

    public function login() {
        include __DIR__ . '/../views/auth/login.php';
    }

    public function authenticate() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: index.php?page=login');
            exit;
        }

        $nric = trim($_POST['nric'] ?? '');
        $password = $_POST['password'] ?? '';

        if (empty($nric) || empty($password)) {
            $errorMessage = 'Sila masukkan NRIC dan kata laluan.';
            include __DIR__ . '/../views/auth/login.php';
            return;
        }

        $user = $this->studentModel->findByNric($nric);

        if (!$user || !password_verify($password, $user['password'])) {
            $errorMessage = 'No. Kad Pengenalan atau kata laluan tidak sah.';
            include __DIR__ . '/../views/auth/login.php';
            return;
        }

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $_SESSION['student_id'] = $user['id'];
        $_SESSION['student_nric'] = $user['nric'];
        $_SESSION['student_name'] = $user['name'];
        $_SESSION['student_program'] = $user['program'];
        $_SESSION['user_role'] = $user['role'];

        header('Location: index.php?page=profile');
        exit;
    }

    public function logout() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        session_unset();
        session_destroy();
        header('Location: index.php?page=login');
        exit;
    }
}
