CREATE DATABASE IF NOT EXISTS `psp_portal` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `psp_portal`;

CREATE TABLE IF NOT EXISTS `students` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `nric` VARCHAR(14) NOT NULL UNIQUE,
    `name` VARCHAR(100) NOT NULL,
    `program` VARCHAR(100) NOT NULL,
    `role` ENUM('student', 'lecturer') NOT NULL DEFAULT 'student',
    `password` VARCHAR(255) NOT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS `student_grades` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `student_id` INT NULL,
    `name` VARCHAR(100) NOT NULL,
    `ic` VARCHAR(14) NOT NULL,
    `marks` DECIMAL(5,2) NOT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT `fk_student_grade` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB;

INSERT INTO `students` (`nric`, `name`, `program`, `role`, `password`) VALUES
('030514075589', 'MUHAMMAD HAFIZ BIN MUHAMMAD AMIN', 'Diploma Teknologi Maklumat (Teknologi Digital)', 'student', '$2y$10$xRZ36jyTUxcAm4QKNgcDOu8PjEwRJ0eVYjPjznvecngdfVeY6mdru'),
('030822135677', 'CHESSTER ANAK TRAVOLTA CANNY KUMBANG', 'Diploma Teknologi Maklumat (Teknologi Digital)', 'student', '$2y$10$xRZ36jyTUxcAm4QKNgcDOu8PjEwRJ0eVYjPjznvecngdfVeY6mdru'),
('040218085433', 'SHAMIL NAZMI BIN SHAHAR', 'Diploma Teknologi Maklumat (Teknologi Digital)', 'student', '$2y$10$xRZ36jyTUxcAm4QKNgcDOu8PjEwRJ0eVYjPjznvecngdfVeY6mdru'),
('820615075521', 'MOHAMMAD NOOR BIN IBRAHIM', 'Jabatan Teknologi Maklumat & Komunikasi', 'lecturer', '$2y$10$xRZ36jyTUxcAm4QKNgcDOu8PjEwRJ0eVYjPjznvecngdfVeY6mdru')
ON DUPLICATE KEY UPDATE `name` = VALUES(`name`), `role` = VALUES(`role`), `program` = VALUES(`program`);


