<?php
$activeRole = $_SESSION['user_role'] ?? 'student';
$pageTitle = ($activeRole === 'lecturer') ? "Profil Pensyarah" : "Profil Pelajar";

$userData = [
    'name' => $_SESSION['student_name'] ?? '',
    'nric' => $_SESSION['student_nric'] ?? '',
    'program' => $_SESSION['student_program'] ?? ''
];

include __DIR__ . '/../layouts/header.php';
?>

<div class="row justify-content-center">
    <div class="col-xl-7 col-lg-9">
        <div class="card theme-card shadow-sm border-0">
            <div class="card-header py-3 bg-white border-bottom">
                <h2 class="h6 mb-0 fw-bold text-dark d-flex align-items-center gap-2">
                    <i class="bi <?= ($activeRole === 'lecturer') ? 'bi-person-workspace' : 'bi-person-badge' ?> text-purple fs-5" aria-hidden="true"></i>
                    <?= ($activeRole === 'lecturer') ? 'Maklumat Pensyarah' : 'Maklumat Pelajar' ?>
                </h2>
            </div>
            <div class="card-body p-4 p-md-5">
                <div class="text-center mb-4">
                    <div class="profile-avatar-box">
                        <i class="bi <?= ($activeRole === 'lecturer') ? 'bi-person-workspace' : 'bi-person-fill' ?>" aria-hidden="true"></i>
                    </div>
                    <h1 class="h4 fw-bold mb-1 text-dark"><?= htmlspecialchars($userData['name']) ?></h1>
                    <p class="text-secondary mb-0"><?= htmlspecialchars($userData['program']) ?></p>
                </div>

                <div class="border-top pt-2">
                    <div class="profile-meta-row d-flex justify-content-between align-items-center py-3">
                        <span class="text-secondary">Nama Penuh</span>
                        <strong class="text-dark"><?= htmlspecialchars($userData['name']) ?></strong>
                    </div>
                    <div class="profile-meta-row d-flex justify-content-between align-items-center py-3">
                        <span class="text-secondary"><?= ($activeRole === 'lecturer') ? 'No. Kad Pengenalan / Staf' : 'Nombor Kad Pengenalan (NRIC)' ?></span>
                        <strong class="font-monospace text-dark fs-6"><?= htmlspecialchars($userData['nric']) ?></strong>
                    </div>
                    <div class="profile-meta-row d-flex justify-content-between align-items-center py-3">
                        <span class="text-secondary"><?= ($activeRole === 'lecturer') ? 'Jabatan / Bahagian' : 'Program Pengajian' ?></span>
                        <span class="fw-semibold text-dark text-end"><?= htmlspecialchars($userData['program']) ?></span>
                    </div>
                    <?php if ($activeRole === 'lecturer'): ?>
                        <div class="profile-meta-row d-flex justify-content-between align-items-center py-3">
                            <span class="text-secondary">Peranan Sistem</span>
                            <span class="text-purple fw-semibold">Pensyarah</span>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>
