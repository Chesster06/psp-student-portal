document.addEventListener('DOMContentLoaded', () => {
    const deleteModalEl = document.getElementById('deleteConfirmModal');
    if (deleteModalEl) {
        const deleteModal = new bootstrap.Modal(deleteModalEl);
        const modalDeleteBtn = document.getElementById('modalDeleteBtn');

        document.querySelectorAll('.btn-delete-confirm').forEach(button => {
            button.addEventListener('click', () => {
                const id = button.getAttribute('data-id');
                if (modalDeleteBtn && id) {
                    modalDeleteBtn.href = `index.php?page=grades-delete&id=${id}`;
                }
                deleteModal.show();
            });
        });
    }

    const pwForm = document.getElementById('passwordExchangeForm');
    if (pwForm) {
        pwForm.addEventListener('submit', (e) => {
            const newPw = document.getElementById('new_password').value;
            const confirmPw = document.getElementById('confirm_password').value;
            if (newPw !== confirmPw) {
                e.preventDefault();
                alert('New Password and Confirm Password do not match.');
            }
        });
    }

    document.querySelectorAll('.modal').forEach(modalEl => {
        modalEl.addEventListener('click', (e) => {
            if (e.target === modalEl) {
                const instance = bootstrap.Modal.getInstance(modalEl) || new bootstrap.Modal(modalEl);
                instance.hide();
            }
        });

        modalEl.querySelectorAll('[data-bs-dismiss="modal"]').forEach(closeBtn => {
            closeBtn.addEventListener('click', (e) => {
                e.preventDefault();
                const instance = bootstrap.Modal.getInstance(modalEl) || new bootstrap.Modal(modalEl);
                instance.hide();
            });
        });

        modalEl.addEventListener('hidden.bs.modal', () => {
            document.querySelectorAll('.modal-backdrop').forEach(bd => bd.remove());
            document.body.classList.remove('modal-open');
            document.body.style.removeProperty('overflow');
            document.body.style.removeProperty('padding-right');
        });
    });

    const avatarInput = document.getElementById('profile_picture_input');
    const avatarPreviewImg = document.getElementById('avatarPreviewImg');
    const avatarPlaceholder = document.getElementById('avatarPreviewPlaceholder');
    const previewFilenameText = document.getElementById('previewFilenameText');
    const validationMsg = document.getElementById('fileUploadValidationMsg');
    const submitAvatarBtn = document.getElementById('submitAvatarBtn');

    if (avatarInput) {
        avatarInput.addEventListener('change', function () {
            const file = this.files[0];
            if (!file) {
                return;
            }

            const allowedExtensions = ['jpg', 'jpeg', 'png'];
            const fileExt = file.name.split('.').pop().toLowerCase();
            const maxSizeBytes = 2 * 1024 * 1024; // 2MB

            if (!allowedExtensions.includes(fileExt)) {
                if (validationMsg) {
                    validationMsg.textContent = 'Format fail tidak sah! Hanya format .jpg, .jpeg, dan .png sahaja dibenarkan.';
                    validationMsg.classList.remove('d-none');
                }
                if (submitAvatarBtn) submitAvatarBtn.disabled = true;
                this.value = '';
                return;
            }

            if (file.size > maxSizeBytes) {
                if (validationMsg) {
                    validationMsg.textContent = 'Saiz fail melebihi 2MB (' + (file.size / (1024 * 1024)).toFixed(2) + 'MB). Sila pilih gambar yang lebih kecil.';
                    validationMsg.classList.remove('d-none');
                }
                if (submitAvatarBtn) submitAvatarBtn.disabled = true;
                this.value = '';
                return;
            }

            if (validationMsg) {
                validationMsg.classList.add('d-none');
                validationMsg.textContent = '';
            }
            if (submitAvatarBtn) submitAvatarBtn.disabled = false;

            const reader = new FileReader();
            reader.onload = function (e) {
                if (avatarPreviewImg) {
                    avatarPreviewImg.src = e.target.result;
                    avatarPreviewImg.style.display = 'block';
                }
                if (avatarPlaceholder) {
                    avatarPlaceholder.classList.add('d-none');
                }
                if (previewFilenameText) {
                    previewFilenameText.textContent = `${file.name} (${(file.size / 1024).toFixed(1)} KB)`;
                }
            };
            reader.readAsDataURL(file);
        });
    }

    const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    if (!prefersReducedMotion && typeof Lenis !== 'undefined') {
        const lenis = new Lenis({
            duration: 1.2,
            easing: (t) => Math.min(1, 1.001 - Math.pow(2, -10 * t)),
            orientation: 'vertical',
            gestureOrientation: 'vertical',
            smoothWheel: true,
            wheelMultiplier: 1.15,
            touchMultiplier: 1.6,
            infinite: false,
        });

        function raf(time) {
            lenis.raf(time);
            requestAnimationFrame(raf);
        }
        requestAnimationFrame(raf);

        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                const href = this.getAttribute('href');
                if (href && href !== '#' && href !== '#main-content' && !this.hasAttribute('data-bs-toggle')) {
                    const target = document.querySelector(href);
                    if (target) {
                        e.preventDefault();
                        lenis.scrollTo(target, { offset: -70 });
                    }
                }
            });
        });
    }

    const revealElements = document.querySelectorAll('.reveal-on-scroll');
    if (revealElements.length > 0 && !prefersReducedMotion && 'IntersectionObserver' in window) {
        document.body.classList.add('js-reveal-ready');
        const revealObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('reveal-visible');
                    observer.unobserve(entry.target);
                }
            });
        }, {
            threshold: 0.08,
            rootMargin: '0px 0px 50px 0px'
        });

        revealElements.forEach(el => revealObserver.observe(el));
    }
});

