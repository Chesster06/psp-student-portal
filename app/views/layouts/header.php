<?php
$activeRole = $_SESSION['user_role'] ?? 'student';
?>
<!DOCTYPE html>
<html lang="ms">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($pageTitle) ? htmlspecialchars($pageTitle) : 'Portal PSP' ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="assets/css/style.css?v=<?= time() ?>">
</head>
<body class="admin-body">

<div class="admin-layout-wrapper">
    <aside class="admin-sidebar" id="adminSidebar">
        <div class="admin-sidebar-header justify-content-center position-relative">
            <a href="index.php?page=profile" class="admin-brand-link w-100 justify-content-center">
                <img src="assets/images/psp_logo.png" alt="Politeknik Seberang Perai" class="admin-logo-full">
                <img src="assets/images/psp_logo.png" alt="PSP" class="admin-logo-mini">
            </a>
            <button type="button" class="btn-close d-lg-none position-absolute end-0 me-3" id="sidebarCloseBtn" aria-label="Tutup menu"></button>
        </div>

        <div class="admin-sidebar-nav-container">
            <div class="sidebar-section-label">Navigasi Utama</div>
            <ul class="nav flex-column admin-nav-list">
                <li class="nav-item">
                    <a class="nav-link admin-nav-link <?= (!isset($_GET['page']) || $_GET['page'] === 'profile') ? 'active' : '' ?>" href="index.php?page=profile" data-tooltip="<?= ($activeRole === 'lecturer') ? 'Profil Pensyarah' : 'Profil Pelajar' ?>">
                        <i class="bi <?= ($activeRole === 'lecturer') ? 'bi-person-workspace' : 'bi-person-badge' ?> admin-nav-icon"></i>
                        <span class="admin-nav-text"><?= ($activeRole === 'lecturer') ? 'Profil Pensyarah' : 'Profil Pelajar' ?></span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link admin-nav-link <?= (isset($_GET['page']) && in_array($_GET['page'], ['grades', 'grades-edit', 'grades-create'])) ? 'active' : '' ?>" href="index.php?page=grades" data-tooltip="<?= ($activeRole === 'lecturer') ? 'Pengurusan Gred' : 'Semakan Gred' ?>">
                        <i class="bi bi-card-checklist admin-nav-icon"></i>
                        <span class="admin-nav-text"><?= ($activeRole === 'lecturer') ? 'Pengurusan Gred' : 'Semakan Gred' ?></span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link admin-nav-link <?= (isset($_GET['page']) && in_array($_GET['page'], ['settings', 'change-password'])) ? 'active' : '' ?>" href="index.php?page=settings" data-tooltip="Tetapan Kata Laluan">
                        <i class="bi bi-gear-fill admin-nav-icon"></i>
                        <span class="admin-nav-text">Tetapan</span>
                    </a>
                </li>
            </ul>

            <div class="sidebar-section-label mt-4">Pautan Luar</div>
            <ul class="nav flex-column admin-nav-list">
                <li class="nav-item">
                    <a class="nav-link admin-nav-link" href="index.php?page=landing" target="_blank" data-tooltip="Laman Utama Portal">
                        <i class="bi bi-globe2 admin-nav-icon"></i>
                        <span class="admin-nav-text">Laman Utama Portal</span>
                    </a>
                </li>
            </ul>
        </div>

        <div class="admin-sidebar-footer">
            <div class="admin-user-card" data-tooltip="<?= htmlspecialchars($_SESSION['student_name'] ?? 'Pengguna') ?>">
                <div class="admin-user-avatar">
                    <i class="bi <?= ($activeRole === 'lecturer') ? 'bi-person-workspace' : 'bi-person-fill' ?>"></i>
                </div>
                <div class="admin-user-info">
                    <div class="admin-user-name"><?= htmlspecialchars($_SESSION['student_name'] ?? 'Pengguna') ?></div>
                    <div class="admin-user-role"><?= ($activeRole === 'lecturer') ? 'Pensyarah JTMK' : htmlspecialchars($_SESSION['student_nric'] ?? '') ?></div>
                </div>
            </div>
            <a href="index.php?page=logout" class="btn btn-outline-danger btn-sm w-100 mt-3 d-flex align-items-center justify-content-center gap-2 min-tap-target admin-logout-btn" data-tooltip="Log Keluar">
                <i class="bi bi-box-arrow-right"></i>
                <span class="admin-logout-text">Log Keluar</span>
            </a>
        </div>
    </aside>

    <div class="admin-sidebar-backdrop" id="sidebarBackdrop"></div>

    <div class="admin-main-area">
        <header class="admin-topbar">
            <div class="d-flex align-items-center gap-3">
                <button type="button" class="btn btn-sm btn-outline-secondary d-lg-none min-tap-target" id="sidebarOpenBtn" aria-label="Buka menu navigasi">
                    <i class="bi bi-list fs-5"></i>
                </button>
                <div>
                    <h1 class="admin-topbar-title mb-0"><?= isset($pageTitle) ? htmlspecialchars($pageTitle) : 'Papan Pemuka' ?></h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb admin-breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="index.php?page=profile"><?= ($activeRole === 'lecturer') ? 'Pensyarah' : 'Pelajar' ?></a></li>
                            <li class="breadcrumb-item active" aria-current="page"><?= isset($pageTitle) ? htmlspecialchars($pageTitle) : 'Paparan' ?></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </header>

        <main class="admin-content-container">
            <div class="admin-page-transition-wrapper">
