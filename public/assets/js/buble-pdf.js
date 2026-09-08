/* ==========================================================================
   BUBBLE DOWNLOAD CATALOG SCRIPT (buble-pdf.js)
   - Mobile: Klik 1 = Memanjang, Klik 2 = Download
   - Desktop: Langsung Download biasa
   ========================================================================== */
document.addEventListener('DOMContentLoaded', () => {
    const bubbleContainer = document.getElementById('bubbleCatalogContainer');
    const catalogLink = document.querySelector('.bubble-catalog-link');
    const btnClose = document.getElementById('btnCloseBubbleCatalog');

    if (!bubbleContainer || !catalogLink) return;

    // Cek preferensi user jika sebelumnya pernah menutup via tombol X
    if (sessionStorage.getItem('catalog_bubble_closed') === 'true') {
        bubbleContainer.classList.add('is-hidden');
    }

    // Logika Klik pada Link / Bubble
    catalogLink.addEventListener('click', (e) => {
        const isMobile = window.innerWidth <= 768;

        // Khusus di Mobile, periksa apakah sudah mekar atau belum
        if (isMobile) {
            if (!bubbleContainer.classList.contains('is-expanded')) {
                // KLIK 1: Cegah download langsung, kembangkan bubble
                e.preventDefault();
                bubbleContainer.classList.add('is-expanded');
                return;
            }
            // KLIK 2: Karena sudah 'is-expanded', biarkan default browser berjalan (download file PDF)
        }
    });

    // Tombol X: Menutup/menghilangkan bubble permanen di sesi tersebut
    if (btnClose) {
        btnClose.addEventListener('click', (e) => {
            e.preventDefault();
            e.stopPropagation();
            bubbleContainer.classList.remove('is-expanded');
            bubbleContainer.classList.add('is-hidden');
            sessionStorage.setItem('catalog_bubble_closed', 'true');
        });
    }

    // Klik di luar area bubble: Otomatis kuncupkan kembali jadi bulat (khusus mobile)
    document.addEventListener('click', (e) => {
        if (window.innerWidth <= 768) {
            if (!bubbleContainer.contains(e.target) && bubbleContainer.classList.contains('is-expanded')) {
                bubbleContainer.classList.remove('is-expanded');
            }
        }
    });
});