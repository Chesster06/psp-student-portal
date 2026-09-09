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

const modal = new bootstrap.Modal(
    document.getElementById('deleteConfirmModal'),
    {
        backdrop: false
    }
);
