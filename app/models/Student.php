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

    public function updatePassword($studentId, $hashedPassword) {
        return false;
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
        return false;
    }

    public function updateGrade($id, $name, $ic, $marks) {
        return false;
    }

    public function deleteGrade($id) {
        return false;
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
