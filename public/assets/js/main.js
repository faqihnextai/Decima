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
        // Percepat putaran video
        heroVideo.playbackRate = 1.6;

        // Ketika video selesai diputar, munculkan teks & tombol
        heroVideo.addEventListener('ended', () => {
            heroTexts.forEach(el => el.classList.add('show'));
        });

        // Fallback jika video gagal play / diblokir browser
        setTimeout(() => {
            heroTexts.forEach(el => el.classList.add('show'));
        }, 3500);
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

/// ==========================================================================
// LOGIKA PRODUK: DELAY AUTO-OPEN 5 DETIK SAAT SCROLL
// ==========================================================================

// Map untuk menyimpan ID timer tiap item produk agar bisa di-clear
const productTimers = new Map();

// 1. Toggle manual jika header produk diklik (langsung buka/tutup tanpa nunggu)
function toggleProductSlider(headerEl) {
    const productItem = headerEl.closest('.product-item');
    if (productItem) {
        // Hentikan timer jika user memutuskan klik manual
        if (productTimers.has(productItem)) {
            clearTimeout(productTimers.get(productItem));
            productTimers.delete(productItem);
        }
        productItem.classList.toggle('is-expanded');
    }
}

// 2. Fungsi buka slider & scroll mulus ke target (misal dari navigasi menu)
function expandAndScrollToProduct(targetId) {
    if (!targetId || !targetId.includes('#prod-')) return;

    const cleanId = targetId.substring(targetId.indexOf('#'));
    const targetEl = document.querySelector(cleanId);
    
    if (targetEl) {
        const navOffset = 90;
        const elementPosition = targetEl.getBoundingClientRect().top;
        const offsetPosition = elementPosition + window.pageYOffset - navOffset;

        window.scrollTo({
            top: offsetPosition,
            behavior: 'smooth'
        });

        targetEl.classList.add('is-expanded');
    }
}

document.addEventListener('DOMContentLoaded', () => {
    const allProducts = document.querySelectorAll('.product-item');

    // Matikan auto expand mouseenter agar tidak merusak jeda 5 detik
    // (User tetap bisa klik judul produk jika ingin buka langsung)

    // B. Logika SCROLLDOWN dengan jeda 5 detik
    if ('IntersectionObserver' in window) {
        const productScrollObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                const item = entry.target;

                if (entry.isIntersecting) {
                    // Hanya set timer jika produk belum terbuka
                    if (!item.classList.contains('is-expanded') && !productTimers.has(item)) {
                        const timer = setTimeout(() => {
                            item.classList.add('is-expanded');
                            productTimers.delete(item);
                        }, 5000); // 5000 ms = Jeda 5 detik buat baca judul & tagline

                        productTimers.set(item, timer);
                    }
                } else {
                    // Jika user scroll lewat/keluar sebelum 5 detik, batalkan timer
                    if (productTimers.has(item)) {
                        clearTimeout(productTimers.get(item));
                        productTimers.delete(item);
                    }
                }
            });
        }, {
            threshold: 0.35,
            rootMargin: '0px 0px -50px 0px'
        });

        allProducts.forEach(item => productScrollObserver.observe(item));
    }

    // C. Interaksi KLIK dari NAVBAR & MOBILE BOTTOM SHEET
    const productLinks = document.querySelectorAll('a[href*="#prod-"]');
    productLinks.forEach(link => {
        link.addEventListener('click', (e) => {
            const href = link.getAttribute('href');
            if (href && href.includes('#prod-')) {
                e.preventDefault();
                expandAndScrollToProduct(href);

                const cleanId = href.substring(href.indexOf('#'));
                history.pushState(null, null, cleanId);
            }
        });
    });

    // D. Tangani jika user membuka web dengan Hash URL langsung
    if (window.location.hash && window.location.hash.startsWith('#prod-')) {
        window.addEventListener('load', () => {
            setTimeout(() => {
                expandAndScrollToProduct(window.location.hash);
            }, 600);
        });
    }
});

document.querySelectorAll('.door-frame-box img').forEach(img => {
    img.addEventListener('click', (e) => {
        e.stopPropagation();
        const lightbox = document.getElementById('doorLightbox');
        const lightboxImg = document.getElementById('doorLightboxImg');
        lightboxImg.src = img.src;
        lightbox.classList.add('is-active');
        document.body.style.overflow = 'hidden'; // Kunci scroll
    });
});

function closeDoorLightbox() {
    const lightbox = document.getElementById('doorLightbox');
    lightbox.classList.remove('is-active');
    document.body.style.overflow = '';
}

function handleProductBack(e, fallbackUrl) {
    // Jika user datang dari landing page, gunakan browser back agar posisi accordion & scroll tetap terjaga
    if (document.referrer && document.referrer.includes(window.location.host)) {
        e.preventDefault();
        window.history.back();
    } else {
        // Jika buka langsung via direct URL, arahkan ke anchor section landing page
        window.location.href = fallbackUrl;
    }
}
