<?php
$activeRole = $_SESSION['user_role'] ?? 'student';
$pageTitle = ($activeRole === 'lecturer') ? "Profil Pensyarah" : "Profil Pelajar";

$userData = [
    'name' => $_SESSION['student_name'] ?? '',
    'nric' => $_SESSION['student_nric'] ?? '',
    'program' => $_SESSION['student_program'] ?? ''
];

$activeProfilePic = $_SESSION['student_profile_picture'] ?? null;
$picFilePath = $activeProfilePic ? __DIR__ . '/../../../public/uploads/profile_pictures/' . $activeProfilePic : null;
$hasCustomPic = ($activeProfilePic && file_exists($picFilePath));

include __DIR__ . '/../layouts/header.php';
?>

<div class="row justify-content-center">
    <div class="col-xl-8 col-lg-10">

        <?php if (!empty($_SESSION['error'])): ?>
            <div class="alert alert-danger alert-dismissible fade show py-3 px-4 shadow-sm border-0 rounded-3 mb-4 d-flex align-items-center gap-3" role="alert">
                <i class="bi bi-exclamation-triangle-fill fs-4 text-danger"></i>
                <div class="flex-grow-1">
                    <strong>Ralat Muat Naik!</strong>
                    <div><?= htmlspecialchars($_SESSION['error']) ?></div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
            </div>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>

        <?php if (!empty($_SESSION['success'])): ?>
            <div class="alert alert-success alert-dismissible fade show py-3 px-4 shadow-sm border-0 rounded-3 mb-4 d-flex align-items-center gap-3" role="alert">
                <i class="bi bi-check-circle-fill fs-4 text-success"></i>
                <div class="flex-grow-1">
                    <strong>Berjaya!</strong>
                    <div><?= htmlspecialchars($_SESSION['success']) ?></div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
            </div>
            <?php unset($_SESSION['success']); ?>
        <?php endif; ?>

        <div class="card theme-card shadow-sm border-0">
            <div class="card-header py-3 bg-white border-bottom d-flex justify-content-between align-items-center">
                <h2 class="h6 mb-0 fw-bold text-dark d-flex align-items-center gap-2">
                    <i class="bi <?= ($activeRole === 'lecturer') ? 'bi-person-workspace' : 'bi-person-badge' ?> text-purple fs-5" aria-hidden="true"></i>
                    <?= ($activeRole === 'lecturer') ? 'Maklumat Pensyarah' : 'Maklumat Pelajar' ?>
                </h2>
                <span class="badge bg-purple-subtle text-purple border border-purple px-2 py-1">
                    <i class="bi bi-shield-check me-1"></i>Akaun Disahkan
                </span>
            </div>

            <div class="card-body p-4 p-md-5">
                <div class="text-center mb-4">
                    <div class="profile-avatar-wrapper">
                        <div class="profile-avatar-box">
                            <?php if ($hasCustomPic): ?>
                                <img src="uploads/profile_pictures/<?= htmlspecialchars($activeProfilePic) ?>" alt="Foto Profil" class="profile-avatar-img" id="currentAvatarImg">
                            <?php else: ?>
                                <i class="bi <?= ($activeRole === 'lecturer') ? 'bi-person-workspace' : 'bi-person-fill' ?>" aria-hidden="true" id="currentAvatarIcon"></i>
                            <?php endif; ?>
                        </div>
                        <button type="button" class="profile-avatar-edit-btn" data-bs-toggle="modal" data-bs-target="#uploadAvatarModal" title="Kemas kini gambar profil" aria-label="Kemas kini gambar profil">
                            <i class="bi bi-camera-fill"></i>
                        </button>
                    </div>

                    <h1 class="h4 fw-bold mb-1 text-dark"><?= htmlspecialchars($userData['name']) ?></h1>
                    <p class="text-secondary mb-3"><?= htmlspecialchars($userData['program']) ?></p>

                    <div class="d-flex justify-content-center gap-2">
                        <button type="button" class="btn btn-sm btn-purple px-3 py-2 d-inline-flex align-items-center gap-2 min-tap-target" data-bs-toggle="modal" data-bs-target="#uploadAvatarModal">
                            <i class="bi bi-cloud-arrow-up-fill"></i>
                            <span><?= $hasCustomPic ? 'Tukar Gambar Profil' : 'Muat Naik Gambar' ?></span>
                        </button>
                        <?php if ($hasCustomPic): ?>
                            <button type="button" class="btn btn-sm btn-outline-danger px-3 py-2 d-inline-flex align-items-center gap-1 min-tap-target" data-bs-toggle="modal" data-bs-target="#deleteAvatarModal">
                                <i class="bi bi-trash3"></i>
                                <span>Padam</span>
                            </button>
                        <?php endif; ?>
                    </div>
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
                    <div class="profile-meta-row d-flex justify-content-between align-items-center py-3">
                        <span class="text-secondary">Status Gambar Profil</span>
                        <?php if ($hasCustomPic): ?>
                            <span class="badge bg-success-subtle text-success border border-success-subtle px-2 py-1">
                                <i class="bi bi-check-circle me-1"></i>Gambar Diperibadikan
                            </span>
                        <?php else: ?>
                            <span class="badge bg-secondary-subtle text-secondary border px-2 py-1">
                                <i class="bi bi-dash-circle me-1"></i>Avatar Lalai
                            </span>
                        <?php endif; ?>
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

<div class="modal fade" id="uploadAvatarModal" tabindex="-1" data-bs-backdrop="false" aria-labelledby="uploadAvatarModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header border-bottom">
                <h5 class="modal-title fw-bold text-dark d-flex align-items-center gap-2" id="uploadAvatarModalLabel">
                    <i class="bi bi-person-bounding-box text-purple"></i>
                    Muat Naik Gambar Profil
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <form action="index.php?page=upload-profile-picture" method="POST" enctype="multipart/form-data" id="avatarUploadForm">
                <div class="modal-body p-4">
                    <div class="text-center mb-3">
                        <div class="avatar-preview-box" id="avatarPreviewContainer">
                            <?php if ($hasCustomPic): ?>
                                <img src="uploads/profile_pictures/<?= htmlspecialchars($activeProfilePic) ?>" alt="Pratonton" id="avatarPreviewImg">
                                <i class="bi bi-image fs-1 text-secondary d-none" id="avatarPreviewPlaceholder"></i>
                            <?php else: ?>
                                <i class="bi bi-image fs-1 text-secondary" id="avatarPreviewPlaceholder"></i>
                                <img src="" alt="Pratonton" id="avatarPreviewImg" style="display: none;">
                            <?php endif; ?>
                        </div>
                        <small class="text-secondary d-block mt-2 fw-medium" id="previewFilenameText">
                            <?= $hasCustomPic ? 'Gambar Profil Semasa' : 'Pratonton Gambar Baharu' ?>
                        </small>
                    </div>

                    <div class="mb-3">
                        <label for="profile_picture_input" class="form-label small fw-semibold text-dark">Pilih Fail Gambar</label>
                        <input type="file" name="profile_picture" id="profile_picture_input" class="form-control login-input-lg" accept=".jpg,.jpeg,.png,image/jpeg,image/png" required>
                        <div id="fileUploadValidationMsg" class="form-text text-danger d-none mt-2"></div>
                    </div>

                    <div class="p-3 bg-light border rounded-3 mb-2 small text-secondary">
                        <div class="fw-semibold text-dark mb-1 d-flex align-items-center gap-1">
                            <i class="bi bi-shield-lock-fill text-purple"></i>
                            Syarat Muat Naik Fail:
                        </div>
                        <ul class="mb-0 ps-3">
                            <li>Format dibenarkan: <strong>.jpg, .jpeg, .png</strong> sahaja.</li>
                            <li>Had saiz maksimum: <strong>2MB</strong> per muat naik.</li>
                            <li>Penamaan semula automatik: Menggunakan <code>uniqid()</code> & <code>time()</code> untuk mencegah pertindihan fail.</li>
                        </ul>
                    </div>
                </div>
                <div class="modal-footer border-top bg-light">
                    <button type="button" class="btn btn-outline-secondary min-tap-target" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-purple min-tap-target" id="submitAvatarBtn">
                        <i class="bi bi-cloud-arrow-up-fill me-1"></i> Simpan & Muat Naik
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php if ($hasCustomPic): ?>
<div class="modal fade" id="deleteAvatarModal" tabindex="-1" data-bs-backdrop="false" aria-labelledby="deleteAvatarModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content border-0 shadow">
            <div class="modal-header border-bottom">
                <h5 class="modal-title fw-bold text-danger d-flex align-items-center gap-2" id="deleteAvatarModalLabel">
                    <i class="bi bi-trash3-fill"></i> Padam Gambar
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body p-3 text-center">
                <p class="mb-0 text-secondary small">
                    Adakah anda pasti ingin memadamkan gambar profil ini? Akaun anda akan kembali menggunakan avatar lalai sistem.
                </p>
            </div>
            <div class="modal-footer border-top bg-light justify-content-center">
                <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                <form action="index.php?page=delete-profile-picture" method="POST" class="d-inline">
                    <button type="submit" class="btn btn-sm btn-danger">
                        <i class="bi bi-trash3 me-1"></i> Sahkan Padam
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>

<?php include __DIR__ . '/../layouts/footer.php'; ?>
