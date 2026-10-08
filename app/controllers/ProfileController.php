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

        $student = $this->studentModel->findByNric($_SESSION['student_nric']);
        if ($student) {
            $_SESSION['student_profile_picture'] = $student['profile_picture'] ?? null;
            $_SESSION['student_name'] = $student['name'];
            $_SESSION['student_program'] = $student['program'];
        }

        include __DIR__ . '/../views/profile/profile.php';
    }

    public function uploadProfilePicture() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (empty($_SESSION['student_nric'])) {
            header('Location: index.php?page=login');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: index.php?page=profile');
            exit;
        }

        if (!isset($_FILES['profile_picture']) || $_FILES['profile_picture']['error'] === UPLOAD_ERR_NO_FILE) {
            $_SESSION['error'] = "Sila pilih satu fail gambar untuk dimuat naik.";
            header('Location: index.php?page=profile');
            exit;
        }

        $file = $_FILES['profile_picture'];

        if ($file['error'] !== UPLOAD_ERR_OK) {
            $_SESSION['error'] = "Ralat semasa memuat naik fail. Sila cuba lagi.";
            header('Location: index.php?page=profile');
            exit;
        }

        $maxSizeBytes = 2 * 1024 * 1024;
        if ($file['size'] > $maxSizeBytes) {
            $_SESSION['error'] = "Saiz fail melebihi had 2MB. Sila muat naik imej bersaiz lebih kecil.";
            header('Location: index.php?page=profile');
            exit;
        }

        if ($file['size'] <= 0) {
            $_SESSION['error'] = "Fail imej yang dimuat naik tidak mempunyai kandungan.";
            header('Location: index.php?page=profile');
            exit;
        }

        $allowedExtensions = ['jpg', 'jpeg', 'png'];
        $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

        if (!in_array($extension, $allowedExtensions, true)) {
            $_SESSION['error'] = "Format fail tidak sah. Hanya fail .jpg, .jpeg, dan .png sahaja dibenarkan.";
            header('Location: index.php?page=profile');
            exit;
        }

        $tmpPath = $file['tmp_name'];
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mimeType = finfo_file($finfo, $tmpPath);
        finfo_close($finfo);

        $allowedMimes = ['image/jpeg', 'image/png'];
        if (!in_array($mimeType, $allowedMimes, true) || @getimagesize($tmpPath) === false) {
            $_SESSION['error'] = "Kandungan fail tidak sah atau bukan fail imej yang tulen.";
            header('Location: index.php?page=profile');
            exit;
        }

        $secureFilename = 'avatar_' . time() . '_' . uniqid('', true) . '.' . $extension;

        $uploadDirectory = __DIR__ . '/../../public/uploads/profile_pictures/';
        if (!is_dir($uploadDirectory)) {
            mkdir($uploadDirectory, 0755, true);
        }

        $destinationPath = $uploadDirectory . $secureFilename;

        $student = $this->studentModel->findByNric($_SESSION['student_nric']);
        if (!$student) {
            $_SESSION['error'] = "Rekod pelajar tidak dijumpai.";
            header('Location: index.php?page=profile');
            exit;
        }

        if (move_uploaded_file($tmpPath, $destinationPath)) {
            if (!empty($student['profile_picture'])) {
                $oldFilePath = $uploadDirectory . $student['profile_picture'];
                if (file_exists($oldFilePath) && is_file($oldFilePath)) {
                    @unlink($oldFilePath);
                }
            }

            $this->studentModel->updateProfilePicture($student['id'], $secureFilename);
            $_SESSION['student_profile_picture'] = $secureFilename;
            $_SESSION['success'] = "Gambar profil berjaya dimuat naik dan dikemas kini!";
        } else {
            $_SESSION['error'] = "Gagal menyimpan fail ke pelayan. Sila pastikan kebenaran direktori mengizinkan penulisan.";
        }

        header('Location: index.php?page=profile');
        exit;
    }

    public function deleteProfilePicture() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (empty($_SESSION['student_nric'])) {
            header('Location: index.php?page=login');
            exit;
        }

        $student = $this->studentModel->findByNric($_SESSION['student_nric']);
        if ($student && !empty($student['profile_picture'])) {
            $uploadDirectory = __DIR__ . '/../../public/uploads/profile_pictures/';
            $filePath = $uploadDirectory . $student['profile_picture'];
            if (file_exists($filePath) && is_file($filePath)) {
                @unlink($filePath);
            }

            $this->studentModel->removeProfilePicture($student['id']);
            $_SESSION['student_profile_picture'] = null;
            $_SESSION['success'] = "Gambar profil berjaya dipadam.";
        }

        header('Location: index.php?page=profile');
        exit;
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