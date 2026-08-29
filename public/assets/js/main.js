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