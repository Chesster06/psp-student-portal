# Politeknik Seberang Perai - Student & Grade Portal

> **Final Year Full-Stack Web Development Mini Project**  
> Diploma Teknologi Maklumat (Teknologi Digital)

---

## Pengenalan
Sistem portal pengurusan gred dan profil pelajar berasaskan seni bina **PHP MVC**, **MySQL**, dan **Bootstrap 5**. Projek ini dibina untuk menyokong kawalan capaian berasaskan peranan (RBAC) bagi pensyarah dan pelajar.

---

## Ciri-Ciri Utama
- **Autentikasi Selamat**: Log masuk menggunakan NRIC dan kata laluan berenkripsi (Bcrypt).
- **Pengasingan Peranan (RBAC)**:
  - **Pensyarah**: Melihat semua senarai gred pelajar, menambah, mengemas kini, dan memadam rekod (CRUD).
  - **Pelajar**: Akses paparan profil dan semakan keputusan gred sendiri sahaja (Read-only).
- **Pengiraan Gred Automatik**: Gred abjad (A, B, C, D, F) dan status (LULUS/GAGAL) dikira secara dinamik berdasarkan markah.
- **Antara Muka Responsif**: Rekaan moden menggunakan Bootstrap 5 dan Bootstrap Icons.

---

## Teknologi yang Digunakan
- **Backend**: PHP 8.x (Custom MVC Architecture, PDO Prepared Statements)
- **Pangkalan Data**: MySQL (InnoDB Engine, Foreign Key Constraints)
- **Frontend**: HTML5, CSS3, JavaScript, Bootstrap 5.3

---

## Struktur Projek
```text
mini-project-1/
├── app/
│   ├── config/          # Konfigurasi database PDO Singleton
│   ├── controllers/     # AuthController, GradeController, ProfileController, HomeController
│   ├── models/          # Student.php (Data layer & pengiraan gred)
│   └── views/           # Antara muka (auth, grades, profile, layouts)
├── database/
│   └── database.sql     # Skrip bina pangkalan data & data ujian
├── public/
│   ├── assets/          # CSS, JS, Images
│   └── index.php        # Front Controller / Routing
└── index.php            # Redirect ke public/index.php
```

---

## Cara Pemasangan & Penggunaan (XAMPP)

1. **Klon / Letakkan Projek**:
   Letakkan folder projek di dalam direktori:
   ```text
   C:\xampp\htdocs\mini-project-1
   ```

2. **Import Pangkalan Data**:
   - Buka **phpMyAdmin** (`http://localhost/phpmyadmin/`).
   - Import fail [database.sql](database/database.sql). Pangkalan data `psp_portal` dan jadual `students` serta `student_grades` akan dicipta secara automatik.

3. **Jalankan Sistem**:
   - Buka pelayar web dan akses:
     ```text
     http://localhost/mini-project-1/public/
     ```

---

## Akaun Ujian (Default Login)

Semua akaun menggunakan kata laluan lalai: **`123456`**

| Peranan | No. Kad Pengenalan (NRIC) | Nama Pengguna | Akses |
| :--- | :--- | :--- | :--- |
| **Pensyarah** | `820615075521` | MOHAMMAD NOOR BIN IBRAHIM | Penuh (CRUD Gred & Profil) |
| **Pelajar** | `030514075589` | MUHAMMAD HAFIZ BIN MUHAMMAD AMIN | Profil & Semakan Gred Sendiri |
| **Pelajar** | `040218085433` | SHAMIL NAZMI BIN SHAHAR | Profil & Semakan Gred Sendiri |
| **Pelajar** | `030822135677` | CHESSTER ANAK TRAVOLTA | Profil & Semakan Gred Sendiri |

---

## Ahli Kumpulan
- **Lead / Core Architecture & Auth**
- **Muhammad Hafiz** (Modul Kemas Kini Kata Laluan & Keselamatan)
- **Shamil Nazmi** (Modul CRUD Pengurusan Gred)
