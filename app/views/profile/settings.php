<?php
$pageTitle = "Tetapan & Keselamatan Kata Laluan";
include __DIR__ . '/../layouts/header.php';
?>

<div class="row justify-content-center">
    <div class="col-xl-8 col-lg-10">
        <div class="card theme-card shadow-sm border-0">
            <div class="card-header py-3 bg-white border-bottom">
                <h2 class="h6 mb-0 fw-bold text-dark d-flex align-items-center gap-2">
                    <i class="bi bi-shield-lock-fill text-purple fs-5" aria-hidden="true"></i>
                    Pertukaran Kata Laluan Akaun
                </h2>
            </div>
            <div class="card-body p-4">
                <?php if (!empty($_SESSION['error'])): ?>
                    <div class="alert alert-danger py-2 px-3 small border-0 rounded-3 mb-4 d-flex align-items-center gap-2">
                        <i class="bi bi-exclamation-circle-fill"></i>
                        <div><?= htmlspecialchars($_SESSION['error']) ?></div>
                    </div>
                    <?php unset($_SESSION['error']); ?>
                <?php endif; ?>

                <?php if (!empty($_SESSION['success'])): ?>
                    <div class="alert alert-success py-2 px-3 small border-0 rounded-3 mb-4 d-flex align-items-center gap-2">
                        <i class="bi bi-check-circle-fill"></i>
                        <div><?= htmlspecialchars($_SESSION['success']) ?></div>
                    </div>
                    <?php unset($_SESSION['success']); ?>
                <?php endif; ?>

                <p class="small text-secondary mb-4">
                    Sila pastikan kata laluan baharu anda mematuhi garis panduan keselamatan. Kata laluan akan disulitkan secara automatik menggunakan teknologi hashing sebelum disimpan ke dalam pangkalan data.
                </p>

                <form action="index.php?page=change-password" method="POST" id="passwordExchangeForm" novalidate>
                    <div class="mb-3">
                        <label for="old_password" class="form-label small fw-semibold text-dark mb-1">Kata Laluan Semasa</label>
                        <div class="input-group">
                            <input type="password" class="form-control login-input-lg" id="old_password" name="old_password" placeholder="Masukkan kata laluan semasa anda" required autocomplete="current-password">
                            <button class="btn btn-outline-secondary border-start-0 border login-password-toggle px-3" type="button" data-target="old_password" aria-label="Lihat kata laluan semasa">
                                <i class="bi bi-eye"></i>
                            </button>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="new_password" class="form-label small fw-semibold text-dark mb-1">Kata Laluan Baharu</label>
                        <div class="input-group">
                            <input type="password" class="form-control login-input-lg" id="new_password" name="new_password" placeholder="Cipta kata laluan baharu" required autocomplete="new-password">
                            <button class="btn btn-outline-secondary border-start-0 border login-password-toggle px-3" type="button" data-target="new_password" aria-label="Lihat kata laluan baharu">
                                <i class="bi bi-eye"></i>
                            </button>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="confirm_password" class="form-label small fw-semibold text-dark mb-1">Pengesahan Kata Laluan Baharu</label>
                        <div class="input-group">
                            <input type="password" class="form-control login-input-lg" id="confirm_password" name="confirm_password" placeholder="Taip semula kata laluan baharu" required autocomplete="new-password">
                            <button class="btn btn-outline-secondary border-start-0 border login-password-toggle px-3" type="button" data-target="confirm_password" aria-label="Lihat pengesahan kata laluan">
                                <i class="bi bi-eye"></i>
                            </button>
                        </div>
                    </div>

                    <div class="p-3 bg-light border rounded-3 mb-4 d-flex flex-column gap-1">
                        <div class="small fw-semibold text-dark mb-1">Syarat Keselamatan Kata Laluan:</div>
                        <div class="pw-req-item"><i class="bi bi-dot"></i>Sekurang-kurangnya 6 aksara.</div>
                        <div class="pw-req-item"><i class="bi bi-dot"></i>Kedua-dua medan kata laluan baharu mestilah sepadan dengan tepat.</div>
                        <div class="pw-req-item"><i class="bi bi-dot"></i>Tidak boleh sama dengan kata laluan semasa.</div>
                    </div>

                    <div class="d-flex justify-content-end gap-2 pt-2 border-top">
                        <button type="reset" class="btn btn-outline-dark px-3 py-2 min-tap-target">
                            Batal
                        </button>
                        <button type="submit" class="btn btn-login-submit px-4 py-2 min-tap-target">
                            <i class="bi bi-check2-circle me-1" aria-hidden="true"></i>Kemas Kini Kata Laluan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.querySelectorAll('.login-password-toggle').forEach(button => {
    button.addEventListener('click', function() {
        const targetId = this.getAttribute('data-target');
        const input = document.getElementById(targetId);
        const icon = this.querySelector('i');
        if (input && icon) {
            const isPassword = input.getAttribute('type') === 'password';
            input.setAttribute('type', isPassword ? 'text' : 'password');
            icon.className = isPassword ? 'bi bi-eye-slash' : 'bi bi-eye';
        }
    });
});
</script>

<?php include __DIR__ . '/../layouts/footer.php'; ?>
