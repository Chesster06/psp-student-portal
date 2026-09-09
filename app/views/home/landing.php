<!DOCTYPE html>
<html lang="ms">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Pelajar PSP - Politeknik Seberang Perai</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="assets/css/style.css?v=<?= time() ?>">
</head>
<body>

<a href="#main-content" class="visually-hidden-focusable btn btn-purple m-2">Langkau ke kandungan utama</a>

<header>
    <nav class="navbar navbar-expand-lg navbar-light sticky-top" aria-label="Navigasi Utama Portal">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="index.php?page=landing">
                <img src="assets/images/kpt_jppkk_logo.png" alt="Kementerian Pengajian Tinggi - JPPKK" class="kpt-brand-logo">
                <span class="brand-divider"></span>
                <img src="assets/images/psp_logo.png" alt="Politeknik Seberang Perai" class="psp-brand-logo">
            </a>
            <button class="navbar-toggler border-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#portalNav" aria-controls="portalNav" aria-expanded="false" aria-label="Buka menu navigasi">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="portalNav">
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link px-3" href="#perkhidmatan">Perkhidmatan Portal</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link px-3" href="#panduan">Panduan Pengguna</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link px-3" href="#bantuan" data-bs-toggle="modal" data-bs-target="#helpModal">Bantuan Teknikal</a>
                    </li>
                </ul>
                <div class="d-flex align-items-center gap-2">
                    <?php if (isset($_SESSION['student_name'])): ?>
                        <a href="index.php?page=profile" class="btn btn-purple px-3 py-2 min-tap-target">
                            <i class="bi bi-person-fill me-1" aria-hidden="true"></i>Profil Saya
                        </a>
                        <a href="index.php?page=logout" class="btn btn-outline-dark px-3 py-2 min-tap-target">Log Keluar</a>
                    <?php else: ?>
                        <a href="index.php?page=login" class="btn btn-purple px-4 py-2 min-tap-target">
                            <i class="bi bi-box-arrow-in-right me-1" aria-hidden="true"></i>Log Masuk Pelajar
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>
</header>

<main id="main-content">
    <section class="hero-section-purple py-5">
        <div class="container py-lg-5">
            <div class="row justify-content-center text-center">
                <div class="col-lg-8">
                    <h1 class="display-5 fw-bold lh-sm mb-3 text-white hero-title-anim">
                        Pusat Perkhidmatan Akademik dan Rekod Pelajar
                    </h1>
                    <p class="lead mb-0 fs-6 max-w-720 mx-auto text-white text-opacity-75 hero-text-anim">
                        Sistem berpusat rasmi untuk warga pelajar Politeknik Seberang Perai menguruskan profil pengajian, menyemak rekod markah penilaian, dan mengawal selia keselamatan akaun siswa.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section id="perkhidmatan" class="py-5 services-section-white">
        <div class="container py-lg-4">
            <div class="text-center max-w-720 mx-auto mb-5 reveal-on-scroll">
                <h2 class="fw-bold text-dark mb-2">Fungsi Utama Portal</h2>
                <p class="text-secondary">
                    Kemudahan digital yang disediakan untuk menyokong pengurusan rekod pengajian anda di Politeknik Seberang Perai.
                </p>
            </div>

            <div class="row g-4">
                <div class="col-md-4 reveal-on-scroll">
                    <div class="card card-white card-interactive-lift h-100 p-4">
                        <div class="text-purple fs-2 mb-3">
                            <i class="bi bi-person-lines-fill" aria-hidden="true"></i>
                        </div>
                        <h3 class="h5 fw-bold text-dark mb-2">Profil Pelajar</h3>
                        <p class="small mb-0 text-secondary">
                            Semakan maklumat peribadi rasmi seperti Nama Penuh, Nombor Kad Pengenalan (NRIC), serta Program Pengajian Diploma yang sedang diikuti. Maklumat ini diselaraskan mengikut pendaftaran jabatan.
                        </p>
                    </div>
                </div>

                <div class="col-md-4 reveal-on-scroll">
                    <div class="card card-white card-interactive-lift h-100 p-4">
                        <div class="text-purple fs-2 mb-3">
                            <i class="bi bi-shield-lock-fill" aria-hidden="true"></i>
                        </div>
                        <h3 class="h5 fw-bold text-dark mb-2">Kawalan Keselamatan Akaun</h3>
                        <p class="small mb-0 text-secondary">
                            Kemudahan pertukaran kata laluan akaun secara kendiri pada bila-bila masa. Sistem mengesahkan kata laluan semasa sebelum membenarkan penetapan kata laluan baharu bagi melindungi privasi pelajar.
                        </p>
                    </div>
                </div>

                <div class="col-md-4 reveal-on-scroll">
                    <div class="card card-white card-interactive-lift h-100 p-4">
                        <div class="text-purple fs-2 mb-3">
                            <i class="bi bi-clipboard2-data-fill" aria-hidden="true"></i>
                        </div>
                        <h3 class="h5 fw-bold text-dark mb-2">Rekod Gred & Markah</h3>
                        <p class="small mb-0 text-secondary">
                            Penyemakan markah penilaian kursus dalam format jadual yang jelas. Membolehkan pihak pengurusan akademik merekod, mengemas kini, dan menyemak prestasi pelajar mengikut semester.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="panduan" class="py-5 panduan-section-dark">
        <div class="container py-lg-4">
            <div class="max-w-720 mx-auto">
                <div class="text-center reveal-on-scroll mb-4">
                    <h2 class="fw-bold text-white mb-2">Panduan Penggunaan Portal</h2>
                    <p class="mb-0 text-white text-opacity-75">
                        Ikuti langkah mudah berikut untuk mengakses dan memanfaatkan kemudahan yang disediakan di portal pelajar:
                    </p>
                </div>
                <div class="d-flex flex-column gap-3">
                    <div class="d-flex gap-3 align-items-start card-dark card-interactive-lift p-3 shadow-sm reveal-on-scroll">
                        <span class="badge bg-purple rounded-circle p-2 px-3 fs-6">1</span>
                        <div>
                            <h3 class="h6 fw-bold mb-1 text-white">Log Masuk Menggunakan NRIC</h3>
                            <p class="small mb-0 text-white text-opacity-75">Masukkan nombor kad pengenalan 12 digit dan kata laluan yang telah didaftarkan.</p>
                        </div>
                    </div>
                    <div class="d-flex gap-3 align-items-start card-dark card-interactive-lift p-3 shadow-sm reveal-on-scroll">
                        <span class="badge bg-purple rounded-circle p-2 px-3 fs-6">2</span>
                        <div>
                            <h3 class="h6 fw-bold mb-1 text-white">Sahkan Maklumat Pengajian</h3>
                            <p class="small mb-0 text-white text-opacity-75">Semak nama, NRIC, dan program diploma anda di halaman profil bagi memastikan data adalah tepat.</p>
                        </div>
                    </div>
                    <div class="d-flex gap-3 align-items-start card-dark card-interactive-lift p-3 shadow-sm reveal-on-scroll">
                        <span class="badge bg-purple rounded-circle p-2 px-3 fs-6">3</span>
                        <div>
                            <h3 class="h6 fw-bold mb-1 text-white">Semak Rekod Penilaian Kursus</h3>
                            <p class="small mb-0 text-white text-opacity-75">Buka bahagian Pengurusan Gred untuk melihat senarai markah dan status penilaian semasa anda.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="cta-section-white py-5">
        <div class="container py-lg-4">
            <div class="text-center max-w-720 mx-auto mb-4 reveal-on-scroll">
                <h2 class="h3 fw-bold mb-2 text-dark">Pautan Pantas & Pengumuman Kampus</h2>
                <p class="mb-0 text-secondary">
                    Saluran rasmi digital dan perkhidmatan sokongan pembelajaran siswa-siswi Politeknik Seberang Perai.
                </p>
            </div>

            <div class="row g-3 justify-content-center">
                <div class="col-md-4 reveal-on-scroll">
                    <div class="card card-white card-interactive-lift h-100 p-3 text-start">
                        <div class="d-flex align-items-center gap-3 mb-2">
                            <div class="badge bg-purple p-2 rounded-3 fs-5">
                                <i class="bi bi-mortarboard-fill text-white" aria-hidden="true"></i>
                            </div>
                            <h3 class="h6 fw-bold mb-0 text-dark">Portal CIDOS PSP</h3>
                        </div>
                        <p class="small text-secondary mb-3">
                            Platform e-Pembelajaran bersepadu untuk muat turun nota kuliah, tugasan kursus, dan aktiviti pembelajaran digital.
                        </p>
                        <a href="https://polycc.cidos.edu.my/" target="_blank" rel="noopener noreferrer" class="btn btn-outline-purple btn-sm mt-auto w-100">
                            <i class="bi bi-box-arrow-up-right me-1" aria-hidden="true"></i>Layari CIDOS
                        </a>
                    </div>
                </div>

                <div class="col-md-4 reveal-on-scroll">
                    <div class="card card-white card-interactive-lift h-100 p-3 text-start">
                        <div class="d-flex align-items-center gap-3 mb-2">
                            <div class="badge bg-purple p-2 rounded-3 fs-5">
                                <i class="bi bi-megaphone-fill text-white" aria-hidden="true"></i>
                            </div>
                            <h3 class="h6 fw-bold mb-0 text-dark">Hal Ehwal Pelajar (HEP)</h3>
                        </div>
                        <p class="small text-secondary mb-2">
                            Maklumat kebajikan siswa, skim perlindungan takaful, penginapan kamsis, serta aktiviti kokurikulum.
                        </p>
                        <div class="small p-2 bg-light border rounded mt-auto d-flex flex-column gap-1">
                            <div class="d-flex align-items-center gap-2">
                                <i class="bi bi-telephone-fill text-purple" aria-hidden="true"></i>
                                <span class="text-dark fw-semibold">No. Telefon Am:</span>
                                <a href="tel:045383322" class="text-secondary text-decoration-none ms-auto">04-5383322</a>
                            </div>
                            <div class="d-flex align-items-center gap-2">
                                <i class="bi bi-whatsapp text-success" aria-hidden="true"></i>
                                <span class="text-dark fw-semibold">Hotline WhatsApp:</span>
                                <a href="https://wa.me/60108691800" target="_blank" rel="noopener noreferrer" class="text-secondary text-decoration-none ms-auto">010-8691800</a>
                            </div>
                            <div class="d-flex align-items-center gap-2">
                                <i class="bi bi-envelope-fill text-purple" aria-hidden="true"></i>
                                <span class="text-dark fw-semibold">E-mel Rasmi:</span>
                                <a href="mailto:jhep@psp.edu.my" class="text-secondary text-decoration-none ms-auto text-break">jhep@psp.edu.my</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 reveal-on-scroll">
                    <div class="card card-white card-interactive-lift h-100 p-3 text-start">
                        <div class="d-flex align-items-center gap-3 mb-2">
                            <div class="badge bg-purple p-2 rounded-3 fs-5">
                                <i class="bi bi-calendar-event-fill text-white" aria-hidden="true"></i>
                            </div>
                            <h3 class="h6 fw-bold mb-0 text-dark">Takwim & Peperiksaan</h3>
                        </div>
                        <p class="small text-secondary mb-3">
                            Semakan tarikh penting semester, pendaftaran kursus ulangan, jadual penilaian berterusan, dan minggu peperiksaan akhir.
                        </p>
                        <button type="button" class="btn btn-outline-purple btn-sm mt-auto w-100" data-bs-toggle="modal" data-bs-target="#helpModal">
                            <i class="bi bi-info-circle me-1" aria-hidden="true"></i>Info Jadual & Bantuan
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<div class="modal fade" id="helpModal" tabindex="-1" aria-labelledby="helpModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title h6 fw-bold text-dark" id="helpModalLabel">
                    <i class="bi bi-info-circle me-2 text-purple"></i>Bantuan Akses & Meja Bantuan ICT
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body small text-secondary">
                <p class="fw-semibold text-dark mb-2">Menghadapi masalah log masuk?</p>
                <ol class="ps-3 mb-3">
                    <li>Pastikan nombor kad pengenalan ditaip tanpa ruang atau tanda sengkang (-).</li>
                    <li>Jika anda terlupa kata laluan, sila hubungi penasihat akademik atau pentadbir sistem makmal JTMK untuk penetapan semula.</li>
                    <li>Pastikan pelayar web anda menyokong sesi aktif (cookies dibenarkan).</li>
                </ol>
                <p class="mb-0 text-muted">Sebarang isu teknikal boleh dirujuk terus kepada Unit ICT di Makmal Komputer JTMK semasa waktu operasi kampus.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-dark btn-sm" data-bs-dismiss="modal">Tutup</button>
                <a href="index.php?page=login" class="btn btn-purple btn-sm">Menuju ke Log Masuk</a>
            </div>
        </div>
    </div>
</div>

<footer class="py-4 mt-auto">
    <div class="container text-center small">
        <p class="mb-1 text-white">Jabatan Teknologi Maklumat dan Komunikasi, Politeknik Seberang Perai</p>
        <p class="mb-0 text-white-50">&copy; <?= date('Y') ?> Portal Pelajar PSP. Hak Cipta Terpelihara.</p>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/lenis@1.1.18/dist/lenis.min.js"></script>
<script src="assets/js/main.js?v=<?= time() ?>"></script>
</body>
</html>
