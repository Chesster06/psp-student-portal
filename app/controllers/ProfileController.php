<?php

require_once __DIR__ . '/../models/Student.php';

class ProfileController {
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
        include __DIR__ . '/../views/profile/profile.php';
    }

    public function settings() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (empty($_SESSION['student_nric'])) {
            header('Location: index.php?page=login');
            exit;
        }
        include __DIR__ . '/../views/profile/settings.php';
    }

    public function changePassword() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $oldPassword = $_POST['old_password'] ?? '';
            $newPassword = $_POST['new_password'] ?? '';
            $confirmPassword = $_POST['confirm_password'] ?? '';
            $studentNric = $_SESSION['student_nric'] ?? null;

            if ($newPassword !== $confirmPassword) {
                $_SESSION['error'] = "Password baru dan pengesahan password tidak sama!";
                header('Location: index.php?page=settings');
                exit;
            }

            if (trim($newPassword) === '') {
                $_SESSION['error'] = "Password baru tidak boleh kosong!";
                header('Location: index.php?page=settings');
                exit;
            }

            if (strlen($newPassword) < 6) {
                $_SESSION['error'] = "Password baru mesti sekurang-kurangnya 6 aksara!";
                header('Location: index.php?page=settings');
                exit;
            }
            
            if ($newPassword === $oldPassword) {
                $_SESSION['error'] = "Password baru tidak boleh sama dengan password lama!";
                header('Location: index.php?page=settings');
                exit;
            }

            $student = $this->studentModel->findByNric($studentNric);

            if ($student && password_verify($oldPassword, $student['password'])) {
                $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
                $this->studentModel->updatePassword($student['id'], $hashedPassword);
                $_SESSION['success'] = "Password berjaya ditukar!";
            } else {
                $_SESSION['error'] = "Password lama adalah salah!";
            }

            header('Location: index.php?page=settings');
            exit;
        }
    }
}