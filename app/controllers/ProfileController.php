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
    }
}
