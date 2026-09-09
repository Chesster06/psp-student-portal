<!DOCTYPE html>
<html lang="ms">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log Masuk - Portal Pelajar Politeknik Seberang Perai</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="assets/css/style.css?v=<?= time() ?>">
</head>
<body class="p-0 m-0">

<div class="login-split-wrapper d-flex flex-column flex-lg-row">
    <div class="login-split-banner col-lg-5 col-xl-5 d-none d-lg-flex min-vh-100 anim-banner-enter">
        <div class="mb-4">
            <a href="index.php?page=landing" class="text-white text-decoration-none d-inline-flex align-items-center gap-2 small opacity-75 hover-opacity-100">
                <i class="bi bi-arrow-left"></i>
                Kembali ke Laman Utama
            </a>
        </div>

        <div class="login-banner-content">
            <h1 class="login-banner-title">
                Selamat Datang ke<br>Portal Siswa PSP.
            </h1>
            <p class="login-banner-desc mb-0">
                Akses pantas bagi semakan profil peribadi, status penilaian berterusan semester, dan pengurusan rekod akademik Politeknik Seberang Perai.
            </p>
        </div>

        <div class="pt-5 border-top border-white border-opacity-10">
            <div class="d-flex align-items-center justify-content-between text-white text-opacity-50 small">
                <span>Jabatan Teknologi Maklumat & Komunikasi</span>
                <span>&copy; <?= date('Y') ?> PSP</span>
            </div>
        </div>
    </div>

    <div class="col-lg-7 col-xl-7 d-flex align-items-center justify-content-center min-vh-100 bg-white">
        <div class="login-split-form-container anim-form-enter">
            <div class="d-flex align-items-center justify-content-end mb-4 d-lg-none">
                <a href="index.php?page=landing" class="btn-close" aria-label="Tutup"></a>
            </div>

            <div class="mb-4 anim-stagger-1">
                <h2 class="h3 fw-bold text-dark mb-1">Log Masuk Akaun</h2>
                <p class="text-secondary small mb-0">
                    Masukkan nombor pengenalan dan kata laluan berdaftar anda untuk meneruskan.
                </p>
            </div>

            <?php if (!empty($errorMessage)): ?>
                <div class="alert alert-danger py-2 px-3 small border-0 rounded-3 mb-4 d-flex align-items-center gap-2 anim-stagger-1">
                    <i class="bi bi-exclamation-circle-fill"></i>
                    <div><?= htmlspecialchars($errorMessage) ?></div>
                </div>
            <?php endif; ?>

            <form action="index.php?page=authenticate" method="POST" id="loginForm">
                <div class="mb-3 anim-stagger-2">
                    <label for="nric" class="form-label small fw-semibold text-dark mb-1">NRIC / Nombor Kad Pengenalan</label>
                    <div class="position-relative">
                        <input type="text" class="form-control login-input-lg" id="nric" name="nric" placeholder="Contoh: 030101015566" required autofocus autocomplete="username">
                    </div>
                    <div class="form-text small text-muted">12 digit tanpa tanda sengkang (-).</div>
                </div>

                <div class="mb-4 anim-stagger-3">
                    <div class="d-flex justify-content-between align-items-center mb-1">
                        <label for="password" class="form-label small fw-semibold text-dark mb-0">Kata Laluan</label>
                    </div>
                    <div class="input-group">
                        <input type="password" class="form-control login-input-lg border-end-0" id="password" name="password" placeholder="Masukkan kata laluan akaun" required autocomplete="current-password">
                        <button class="btn btn-outline-secondary border-start-0 border login-password-toggle px-3" type="button" id="togglePasswordBtn" aria-label="Lihat kata laluan">
                            <i class="bi bi-eye" id="togglePasswordIcon"></i>
                        </button>
                    </div>
                </div>

                <div class="d-grid mb-4 anim-stagger-4">
                    <button type="submit" class="btn btn-login-submit">
                        <i class="bi bi-box-arrow-in-right me-2"></i>Log Masuk Portal
                    </button>
                </div>

                <div class="text-center pt-2 border-top anim-stagger-4">
                    <span class="small text-muted">Bantuan teknikal? Sila rujuk meja bantuan Unit ICT JTMK</span>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
const togglePasswordBtn = document.getElementById('togglePasswordBtn');
const passwordInput = document.getElementById('password');
const togglePasswordIcon = document.getElementById('togglePasswordIcon');

if (togglePasswordBtn && passwordInput && togglePasswordIcon) {
    togglePasswordBtn.addEventListener('click', function() {
        const isPassword = passwordInput.getAttribute('type') === 'password';
        passwordInput.setAttribute('type', isPassword ? 'text' : 'password');
        togglePasswordIcon.className = isPassword ? 'bi bi-eye-slash' : 'bi bi-eye';
    });
}
</script>
</body>
</html>
