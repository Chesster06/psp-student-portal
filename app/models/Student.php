<?php

require_once __DIR__ . '/../config/config.php';

class Student {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function findByNric($nric) {
        $stmt = $this->db->prepare("SELECT * FROM students WHERE nric = :nric LIMIT 1");
        $stmt->execute([':nric' => $nric]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ?: null;
    }

    public function findById($id) {
        $stmt = $this->db->prepare("SELECT * FROM students WHERE id = :id LIMIT 1");
        $stmt->execute([':id' => $id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ?: null;
    }

    public function updateProfilePicture($studentId, $filename) {
        $stmt = $this->db->prepare("UPDATE students SET profile_picture = :profile_picture WHERE id = :id");
        return $stmt->execute([
            ':profile_picture' => $filename,
            ':id' => $studentId
        ]);
    }

    public function removeProfilePicture($studentId) {
        $stmt = $this->db->prepare("UPDATE students SET profile_picture = NULL WHERE id = :id");
        return $stmt->execute([
            ':id' => $studentId
        ]);
    }

    public function updatePassword($studentId, $hashedPassword) {
        $stmt = $this->db->prepare("UPDATE students SET password = :password WHERE id = :id");
        return $stmt->execute([
            ':password' => $hashedPassword,
            ':id' => $studentId
        ]);
    }

    public function getAllGrades() {
        $stmt = $this->db->query("SELECT * FROM student_grades ORDER BY id ASC");
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($rows as &$row) {
            $row['grade'] = $this->calculateGrade($row['marks']);
            $row['status'] = ($row['marks'] >= 40) ? 'LULUS' : 'GAGAL';
        }
        return $rows;
    }

    public function getGradeByIc($ic) {
        $stmt = $this->db->prepare("SELECT * FROM student_grades WHERE ic = :ic LIMIT 1");
        $stmt->execute([':ic' => $ic]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            $row['grade'] = $this->calculateGrade($row['marks']);
            $row['status'] = ($row['marks'] >= 40) ? 'LULUS' : 'GAGAL';
        }
        return $row ?: null;
    }

    public function getGradeById($id) {
        $stmt = $this->db->prepare("SELECT * FROM student_grades WHERE id = :id LIMIT 1");
        $stmt->execute([':id' => $id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            $row['grade'] = $this->calculateGrade($row['marks']);
            $row['status'] = ($row['marks'] >= 40) ? 'LULUS' : 'GAGAL';
        }
        return $row ?: null;
    }

    public function createGrade($name, $ic, $marks) {
        $stmt = $this->db->prepare("INSERT INTO student_grades (name, ic, marks) VALUES (:name, :ic, :marks)");
        return $stmt->execute([
            ':name' => $name,
            ':ic' => $ic,
            ':marks' => $marks
        ]);
    }

    public function updateGrade($id, $name, $ic, $marks) {
        $stmt = $this->db->prepare("UPDATE student_grades SET name = :name, ic = :ic, marks = :marks WHERE id = :id");
        return $stmt->execute([
            ':name' => $name,
            ':ic' => $ic,
            ':marks' => $marks,
            ':id' => $id
        ]);
    }

    public function deleteGrade($id) {
        $stmt = $this->db->prepare("DELETE FROM student_grades WHERE id = :id");
        return $stmt->execute([':id' => $id]);
    }

    private function calculateGrade($marks) {
        if ($marks >= 80) return 'A';
        if ($marks >= 75) return 'A-';
        if ($marks >= 70) return 'B+';
        if ($marks >= 65) return 'B';
        if ($marks >= 60) return 'B-';
        if ($marks >= 55) return 'C+';
        if ($marks >= 50) return 'C';
        if ($marks >= 45) return 'C-';
        if ($marks >= 40) return 'D';
        return 'F';
    }
}