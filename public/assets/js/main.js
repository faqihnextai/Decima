document.addEventListener('DOMContentLoaded', () => {
    // 1. Safe Navigation Toggle
    const menuToggle = document.getElementById('menuToggle');
    const navLinks = document.getElementById('navLinks');
    if (menuToggle && navLinks) {
        menuToggle.addEventListener('click', () => {
            navLinks.classList.toggle('active');
        });
    }

    // 2. Video Animasi Hero & Tagline Trigger
    const heroVideo = document.getElementById('heroVideo');
    const heroTexts = document.querySelectorAll('.hero-text');

    if (heroVideo) {
        // Ketika video selesai diputar, munculkan teks & tombol
        heroVideo.addEventListener('ended', () => {
            heroTexts.forEach(el => el.classList.add('show'));
        });

        // Fallback: Jika video gagal play / diblokir browser, tetap tampilkan teks setelah 3 detik
        setTimeout(() => {
            heroTexts.forEach(el => el.classList.add('show'));
        }, 8000);
    } else {
        heroTexts.forEach(el => el.classList.add('show'));
    }
});

// Logika Dark Mode Sinkron
function updateThemeIcons(theme) {
    const icons = document.querySelectorAll('.theme-icon');
    icons.forEach(icon => {
        icon.textContent = theme === 'dark' ? '☀️' : '🌙';
    });
}

function toggleTheme() {
    const currentTheme = document.documentElement.getAttribute('data-bs-theme');
    const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
    
    document.documentElement.setAttribute('data-bs-theme', newTheme);
    localStorage.setItem('theme', newTheme);
    updateThemeIcons(newTheme);
}

// Inisialisasi ikon saat pertama kali halaman dimuat
document.addEventListener('DOMContentLoaded', () => {
    const activeTheme = document.documentElement.getAttribute('data-bs-theme') || 'light';
    updateThemeIcons(activeTheme);
});

// Intersection Observer untuk animasi halus saat konten di-scroll
document.addEventListener('DOMContentLoaded', () => {
    const reveals = document.querySelectorAll('.reveal-on-scroll');

    if ('IntersectionObserver' in window) {
        const revealObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                    observer.unobserve(entry.target);
                }
            });
        }, {
            threshold: 0.15,
            rootMargin: '0px 0px -40px 0px'
        });

        reveals.forEach(el => revealObserver.observe(el));
    } else {
        reveals.forEach(el => el.classList.add('is-visible'));
    }
});

// ==========================================================================
// LOGIKA PRODUK: SLIDER HOVER, SCROLL-AUTO-OPEN & HEADER CLICK
// ==========================================================================

// 1. Toggle manual jika header produk diklik
function toggleProductSlider(headerEl) {
    const productItem = headerEl.closest('.product-item');
    if (productItem) {
        productItem.classList.toggle('is-expanded');
    }
}

// 2. Fungsi buka slider & scroll mulus ke target
function expandAndScrollToProduct(targetId) {
    if (!targetId || !targetId.includes('#prod-')) return;

    // Ambil hash murni jika URL memuat path (misal: /#prod-xxx)
    const cleanId = targetId.substring(targetId.indexOf('#'));
    const targetEl = document.querySelector(cleanId);
    
    if (targetEl) {
        // Offset tinggi navbar
        const navOffset = 90;
        const elementPosition = targetEl.getBoundingClientRect().top;
        const offsetPosition = elementPosition + window.pageYOffset - navOffset;

        window.scrollTo({
            top: offsetPosition,
            behavior: 'smooth'
        });

        // Buka slider otomatis
        targetEl.classList.add('is-expanded');
    }
}

document.addEventListener('DOMContentLoaded', () => {
    const allProducts = document.querySelectorAll('.product-item');

    // A. Interaksi HOVER di Desktop (Buka saat cursor masuk)
    allProducts.forEach(item => {
        item.addEventListener('mouseenter', () => {
            item.classList.add('is-expanded');
        });
    });

    // B. Interaksi SCROLL OTOMATIS (Saat di-scroll masuk layar, otomatis buka)
    if ('IntersectionObserver' in window) {
        const productScrollObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                // Terbuka otomatis saat 35% bagian produk terlihat di viewport
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-expanded');
                }
            });
        }, {
            threshold: 0.35,
            rootMargin: '0px 0px -50px 0px'
        });

        allProducts.forEach(item => productScrollObserver.observe(item));
    }

    // C. Interaksi KLIK dari NAVBAR DESKTOP & MOBILE BOTTOM SHEET
    const productLinks = document.querySelectorAll('a[href*="#prod-"]');
    productLinks.forEach(link => {
        link.addEventListener('click', (e) => {
            const href = link.getAttribute('href');
            if (href && href.includes('#prod-')) {
                e.preventDefault(); // Cegah loncat instan browser
                expandAndScrollToProduct(href);

                // Update hash di URL tanpa reload
                const cleanId = href.substring(href.indexOf('#'));
                history.pushState(null, null, cleanId);
            }
        });
    });

// D. Tangani jika user membuka web dengan Hash URL langsung (Direct Link atau tombol Back)
    if (window.location.hash && window.location.hash.startsWith('#prod-')) {
        // Beri jeda lebih lama agar semua aset (gambar, CSS) selesai dimuat sebelum menggulir
        window.addEventListener('load', () => {
            setTimeout(() => {
                expandAndScrollToProduct(window.location.hash);
            }, 600); // 600 milidetik memberikan waktu agar layout stabil
        });
    }
});