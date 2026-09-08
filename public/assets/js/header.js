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
 * Product Navigation Handler (Lintas Halaman & Single Page)
 */
document.addEventListener('DOMContentLoaded', () => {
    const productLinks = document.querySelectorAll('.mobile-sheet-body a, .desktop-dropdown-menu a');

    productLinks.forEach((link) => {
        link.addEventListener('click', function (e) {
            const href = this.getAttribute('href');
            if (!href) return;

            // Ambil nama hash ID (misal: prod-single-fire-door)
            const hashIndex = href.indexOf('#');
            if (hashIndex === -1) return;

            const targetId = href.substring(hashIndex + 1);
            const targetEl = document.getElementById(targetId);

            // 1. KONDISI DI LANDING PAGE (Elemen ditemukan langsung di DOM)
            if (targetEl) {
                e.preventDefault();
                window.closeMobileProductSheet();

                // Tutup dropdown desktop jika sedang terbuka
                document.querySelectorAll('.dropdown-product-wrapper.active').forEach((w) => {
                    w.classList.remove('active');
                });

                // Scroll ke produk
                targetEl.scrollIntoView({ behavior: 'smooth', block: 'start' });

                // Buka accordion/slider produknya
                if (typeof expandAndScrollToProduct === 'function') {
                    expandAndScrollToProduct('#' + targetId);
                }
            } 
            // 2. KONDISI DI DETAIL PRODUCT / HALAMAN LAIN (Elemen tidak ada)
            else {
                e.preventDefault(); // Cegah hanya sekadar nempel hash di URL saat ini
                window.closeMobileProductSheet();

                // Bersihkan URL tujuan agar dipaksa lari ke root domain + hash
                // Contoh: http://localhost:8080/#prod-double-fire-door
                const origin = window.location.origin;
                window.location.href = origin + '/#' + targetId;
            }
        });
    });
});



/**
 * Mobile Scroll Detection (Hide Logo, Bubble, & Bottom Bar on Scroll Down, Show on Scroll Up)
 */
(function () {
    let lastScrollPosition = 0;
    let isTicking = false;
    const scrollThreshold = 10;

    function getScrollPosition() {
        return window.pageYOffset || document.documentElement.scrollTop || document.body.scrollTop || 0;
    }

    function handleScrollUpdate() {
        if (window.innerWidth >= 768) {
            isTicking = false;
            return;
        }

        const logo = document.getElementById('floatingBrandLogo');
        const bubble = document.getElementById('mobileFloatingBubble');
        const bottomBar = document.getElementById('mobileBottomBar');
        const currentScroll = getScrollPosition();
        const delta = currentScroll - lastScrollPosition;

        if (currentScroll < 0) {
            isTicking = false;
            return;
        }

        // Scroll Down -> Sembunyikan Logo, Bubble, dan Bottom Bar
        if (delta > scrollThreshold && currentScroll > 40) {
            if (logo && !logo.classList.contains('is-hidden-scroll')) {
                logo.classList.add('is-hidden-scroll');
            }
            if (bubble && !bubble.classList.contains('is-hidden-scroll')) {
                bubble.classList.add('is-hidden-scroll');
            }
            if (bottomBar && !bottomBar.classList.contains('is-hidden-scroll')) {
                bottomBar.classList.add('is-hidden-scroll');
            }
        }
        // Scroll Up / Di puncak -> Tampilkan kembali
        else if (delta < -scrollThreshold || currentScroll <= 15) {
            if (logo && logo.classList.contains('is-hidden-scroll')) {
                logo.classList.remove('is-hidden-scroll');
            }
            if (bubble && bubble.classList.contains('is-hidden-scroll')) {
                bubble.classList.remove('is-hidden-scroll');
            }
            if (bottomBar && bottomBar.classList.contains('is-hidden-scroll')) {
                bottomBar.classList.remove('is-hidden-scroll');
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