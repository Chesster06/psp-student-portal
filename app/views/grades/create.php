<?php
$pageTitle = "Add New Student Record";
include __DIR__ . '/../layouts/header.php';
?>

<div class="row justify-content-center">
    <div class="col-md-7">
        <div class="card theme-card shadow-sm">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0 fw-bold text-dark">
                    <i class="bi bi-person-plus-fill text-purple me-2"></i>Tambah Rekod Pelajar
                </h5>
                <a href="index.php?page=grades" class="btn btn-outline-dark btn-sm">
                    <i class="bi bi-arrow-left me-1"></i>Back to List
                </a>
            </div>
            <div class="card-body p-4">
                <form action="index.php?page=grades-store" method="POST" id="createStudentForm">
                    <div class="mb-3">
                        <label for="name" class="form-label fw-semibold small text-dark">Student Full Name</label>
                        <input type="text" class="form-control" id="name" name="name" required placeholder="Enter student full name">
                    </div>
                    <div class="mb-3">
                        <label for="ic" class="form-label fw-semibold small text-dark">IC / NRIC Number</label>
                        <input type="text" class="form-control" id="ic" name="ic" required placeholder="e.g. 030201081122">
                    </div>
                    <div class="mb-4">
                        <label for="marks" class="form-label fw-semibold small text-dark">Marks (0.00 - 100.00)</label>
                        <input type="number" step="0.01" min="0" max="100" class="form-control" id="marks" name="marks" required placeholder="e.g. 88.50">
                    </div>
                    <div class="d-flex justify-content-end gap-2">
                        <a href="index.php?page=grades" class="btn btn-outline-secondary">Cancel</a>
                        <button type="submit" class="btn btn-purple px-4 shadow-sm">
                            <i class="bi bi-save me-1"></i>Save Record
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>
