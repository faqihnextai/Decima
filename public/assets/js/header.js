/**
 * Global Navigation & Sheet Handlers (Attached to window)
 */
window.openMobileProductSheet = function (el) {
    const overlay = document.getElementById('mobileProductOverlay');
    const sheet = document.getElementById('mobileProductSheet');
    if (overlay) overlay.classList.add('show');
    if (sheet) sheet.classList.add('show');
    if (el) window.setActiveNav(el);
};

window.closeMobileProductSheet = function () {
    const overlay = document.getElementById('mobileProductOverlay');
    const sheet = document.getElementById('mobileProductSheet');
    if (overlay) overlay.classList.remove('show');
    if (sheet) sheet.classList.remove('show');
};

window.setActiveNav = function (el) {
    document.querySelectorAll('.mobile-bottom-nav').forEach((item) => {
        item.classList.remove('active');
    });
    if (el) el.classList.add('active');
};

window.toggleDesktopDropdown = function (event) {
    if (event) event.stopPropagation();
    const wrapper = event.currentTarget.closest('.dropdown-product-wrapper');
    if (wrapper) wrapper.classList.toggle('active');
};

// Tutup dropdown desktop saat klik di luar area menu
document.addEventListener('click', function (e) {
    if (!e.target.closest('.dropdown-product-wrapper')) {
        document.querySelectorAll('.dropdown-product-wrapper.active').forEach((w) => {
            w.classList.remove('active');
        });
    }
});

/**
 * Mobile Scroll Detection (Hide Logo & Bubble on Scroll Down, Show on Scroll Up)
 */
(function () {
    let lastScrollPosition = 0;
    let isTicking = false;
    const scrollThreshold = 10;

    function getScrollPosition() {
        return window.pageYOffset || document.documentElement.scrollTop || document.body.scrollTop || 0;
    }

    function handleScrollUpdate() {
        // Hanya eksekusi logika hide/show pada mode mobile (< 768px)
        if (window.innerWidth >= 768) {
            isTicking = false;
            return;
        }

        const logo = document.getElementById('floatingBrandLogo');
        const bubble = document.getElementById('mobileFloatingBubble');
        const currentScroll = getScrollPosition();
        const delta = currentScroll - lastScrollPosition;

        // Cegah efek bounce overscroll di iOS/Safari
        if (currentScroll < 0) {
            isTicking = false;
            return;
        }

        // Scroll Down -> Sembunyikan Logo & Bubble
        if (delta > scrollThreshold && currentScroll > 40) {
            if (logo && !logo.classList.contains('is-hidden-scroll')) {
                logo.classList.add('is-hidden-scroll');
            }
            if (bubble && !bubble.classList.contains('is-hidden-scroll')) {
                bubble.classList.add('is-hidden-scroll');
            }
        }
        // Scroll Up / Di puncak halaman -> Munculkan kembali
        else if (delta < -scrollThreshold || currentScroll <= 15) {
            if (logo && logo.classList.contains('is-hidden-scroll')) {
                logo.classList.remove('is-hidden-scroll');
            }
            if (bubble && bubble.classList.contains('is-hidden-scroll')) {
                bubble.classList.remove('is-hidden-scroll');
            }
        }

        lastScrollPosition = currentScroll;
        isTicking = false;
    }

    window.addEventListener('scroll', () => {
        if (!isTicking) {
            window.requestAnimationFrame(handleScrollUpdate);
            isTicking = true;
        }
    }, { passive: true });
})();

/**
 * Product Detail Click & Scroll Trigger Handler
 */
document.addEventListener('DOMContentLoaded', () => {
    const productLinks = document.querySelectorAll('.mobile-sheet-body a, .desktop-dropdown-menu a');

    productLinks.forEach((link) => {
        link.addEventListener('click', function (e) {
            const href = this.getAttribute('href');
            if (!href || !href.includes('#')) return;

            const targetId = href.substring(href.indexOf('#') + 1);
            const targetEl = document.getElementById(targetId);

            if (targetEl) {
                e.preventDefault();
                window.closeMobileProductSheet();

                // Smooth scroll ke target elemen produk
                targetEl.scrollIntoView({ behavior: 'smooth', block: 'start' });

                // Buka otomatis jika target menggunakan collapse / accordion / tab / modal bootstrap
                const interactiveTrigger = targetEl.querySelector('[data-bs-toggle], .btn-detail, .accordion-button');
                if (interactiveTrigger) {
                    interactiveTrigger.click();
                }
            }
        });
    });
});