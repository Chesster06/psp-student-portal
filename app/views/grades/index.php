<?php
$role = $_SESSION['user_role'] ?? 'student';
$pageTitle = ($role === 'lecturer') ? "Pengurusan Gred Pelajar" : "Semakan Gred Pelajar";
include __DIR__ . '/../layouts/header.php';
?>

<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
    <div>
        <h2 class="h5 fw-bold text-dark mb-1 d-flex align-items-center gap-2">
            <i class="bi bi-card-checklist text-purple"></i>
            <?= ($role === 'lecturer') ? 'Pengurusan Gred' : 'Semakan Gred' ?>
        </h2>
        <p class="small text-secondary mb-0">
            <?= ($role === 'lecturer') 
                ? 'Kebenaran penuh untuk menambah, mengemas kini dan memadam rekod markah pelajar.' 
                : 'Paparan rasmi keputusan penilaian dan markah anda bagi semester semasa.' ?>
        </p>
    </div>
</div>

<?php if ($role === 'lecturer'): ?>
    <div class="card theme-card shadow-sm border-0">
        <div class="card-header py-3 bg-white border-bottom d-flex justify-content-between align-items-center flex-wrap gap-2">
            <div>
                <span class="fw-bold text-dark">Senarai Markah Semua Pelajar</span>
                <span class="small text-secondary ms-2">(Total: <?= count($grades) ?> rekod)</span>
            </div>
            <a href="index.php?page=grades-create" class="btn btn-purple btn-sm px-3 shadow-sm">
                <i class="bi bi-plus-circle me-1"></i>Tambah Rekod Pelajar
            </a>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th scope="col" class="ps-4" style="width: 60px;">#</th>
                            <th scope="col">Nama Pelajar</th>
                            <th scope="col">No. Kad Pengenalan</th>
                            <th scope="col" class="text-center">Markah</th>
                            <th scope="col" class="text-center">Gred</th>
                            <th scope="col" class="text-center">Status</th>
                            <th scope="col" class="text-end pe-4" style="width: 180px;">Tindakan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($grades)): ?>
                            <tr>
                                <td colspan="7" class="text-center py-5 text-secondary">
                                    <i class="bi bi-inbox fs-1 d-block mb-2 text-muted"></i>
                                    Tiada rekod markah pelajar dijumpai. Sila klik <strong>Tambah Rekod Pelajar</strong> untuk mula memasukkan rekod.
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($grades as $index => $row): ?>
                                <tr>
                                    <td class="ps-4 text-secondary small"><?= $index + 1 ?></td>
                                    <td class="fw-semibold text-dark"><?= htmlspecialchars($row['name']) ?></td>
                                    <td class="font-monospace text-secondary"><?= htmlspecialchars($row['ic']) ?></td>
                                    <td class="text-center font-monospace fw-bold text-dark"><?= htmlspecialchars($row['marks']) ?></td>
                                    <td class="text-center fw-bold text-purple"><?= htmlspecialchars($row['grade']) ?></td>
                                    <td class="text-center text-success fw-medium small"><?= htmlspecialchars($row['status']) ?></td>
                                    <td class="text-end pe-4">
                                        <a href="index.php?page=grades-edit&id=<?= $row['id'] ?>" class="btn btn-sm btn-outline-purple me-1">
                                            <i class="bi bi-pencil-square me-1"></i>Edit
                                        </a>
                                        <button type="button" class="btn btn-sm btn-outline-danger btn-delete-confirm" data-id="<?= $row['id'] ?>">
                                            <i class="bi bi-trash me-1"></i>Padam
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php else: ?>
    <?php
    $myRecord = !empty($grades) ? $grades[0] : null;
    $myMarks = $myRecord ? floatval($myRecord['marks']) : null;
    $myGrade = $myRecord ? $myRecord['grade'] : '-';
    $myStatus = $myRecord ? $myRecord['status'] : 'BELUM DINILAI';
    ?>
    <div class="row justify-content-center">
        <div class="col-xl-9 col-lg-10">
            <div class="card theme-card shadow-sm border-0">
                <div class="card-header py-3 bg-white border-bottom">
                    <h2 class="h6 fw-bold text-dark mb-0 d-flex align-items-center gap-2">
                        <i class="bi bi-mortarboard-fill text-purple fs-5"></i>
                        Slip Keputusan Kursus Penilaian Semester
                    </h2>
                </div>

                <div class="card-body p-4 p-md-5">
                    <?php if ($myRecord): ?>
                        <div class="row align-items-center mb-4 pb-4 border-bottom g-4">
                            <div class="col-md-7">
                                <h3 class="h5 fw-bold text-dark mb-1">DFP40443 Full Stack Web Development</h3>
                                <p class="text-secondary small mb-0">Jabatan Teknologi Maklumat & Komunikasi (JTMK)</p>
                            </div>
                            <div class="col-md-5 text-md-end">
                                <div class="d-inline-flex flex-column align-items-md-end">
                                    <span class="small text-secondary text-uppercase fw-semibold">Gred Keseluruhan</span>
                                    <div class="display-4 fw-bold text-purple lh-1"><?= htmlspecialchars($myGrade) ?></div>
                                </div>
                            </div>
                        </div>

                        <div class="row g-3">
                            <div class="col-sm-6">
                                <div class="p-3 bg-light rounded-3 border">
                                    <div class="small text-secondary mb-1">Nama Pelajar</div>
                                    <div class="fw-bold text-dark"><?= htmlspecialchars($myRecord['name']) ?></div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="p-3 bg-light rounded-3 border">
                                    <div class="small text-secondary mb-1">No. Kad Pengenalan (NRIC)</div>
                                    <div class="fw-bold font-monospace text-dark"><?= htmlspecialchars($myRecord['ic']) ?></div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="p-3 bg-light rounded-3 border">
                                    <div class="small text-secondary mb-1">Markah Diperoleh</div>
                                    <div class="fw-bold font-monospace text-dark fs-5"><?= number_format($myMarks, 2) ?> <span class="fs-6 text-secondary fw-normal">/ 100.00</span></div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="p-3 bg-light rounded-3 border">
                                    <div class="small text-secondary mb-1">Status Penilaian</div>
                                    <div class="fw-bold <?= ($myStatus === 'LULUS') ? 'text-success' : 'text-danger' ?> fs-5"><?= htmlspecialchars($myStatus) ?></div>
                                </div>
                            </div>
                        </div>
                    <?php else: ?>
                        <div class="text-center py-5">
                            <i class="bi bi-inbox text-secondary display-4"></i>
                            <h4 class="h6 fw-bold text-dark mt-3">Tiada Rekod Penilaian</h4>
                            <p class="small text-secondary mb-0">Markah anda belum dimasukkan atau dikemaskini oleh pensyarah kursus.</p>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="card-footer bg-white border-top p-3 small text-secondary">
                    <i class="bi bi-info-circle me-1 text-purple"></i>
                    Nota: Penyata keputusan ini adalah rasmi dan hanya boleh dikemas kini oleh Pensyarah Kursus.
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>

<div class="modal fade" id="deleteConfirmModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title h6 mb-0" id="deleteModalLabel"><i class="bi bi-exclamation-triangle-fill me-2"></i>Pengesahan Padam Rekod</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body text-secondary">
                Adakah anda pasti mahu memadam rekod pelajar ini secara kekal daripada sistem? Tindakan ini tidak boleh diundur.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
                <a href="#" id="modalDeleteBtn" class="btn btn-danger btn-sm">Ya, Padam Rekod</a>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>
