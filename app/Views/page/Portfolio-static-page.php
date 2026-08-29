<?php
helper('url');
$currentLocale = session()->get('locale') ?? 'id';

// Menentukan teks berdasarkan locale aktif
$title = ($currentLocale === 'en' && !empty($portfolio['title_en'])) ? $portfolio['title_en'] : $portfolio['title'];
$desc  = ($currentLocale === 'en' && !empty($portfolio['description_en'])) ? $portfolio['description_en'] : $portfolio['description'];
$date  = $portfolio['date'] ?? $portfolio['created_at'] ?? date('Y-m-d');
$imgSrc = !empty($portfolio['image']) 
    ? base_url('uploads/portfolio/' . $portfolio['image']) 
    : 'https://images.unsplash.com/photo-1541888946425-d0fbb18086f6?w=1200&auto=format&fit=crop&q=80';

function formatTanggalDetail($dateStr, $locale = 'id') {
    if (empty($dateStr)) return date('d M Y');
    $time = strtotime($dateStr);
    if ($locale === 'en') return date('l, d F Y', $time);

    $hari = ['Sunday' => 'Minggu', 'Monday' => 'Senin', 'Tuesday' => 'Selasa', 'Wednesday' => 'Rabu', 'Thursday' => 'Kamis', 'Friday' => 'Jumat', 'Saturday' => 'Sabtu'];
    $bulan = [1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
    return ($hari[date('l', $time)] ?? '') . ', ' . date('d', $time) . ' ' . ($bulan[(int)date('m', $time)] ?? '') . ' ' . date('Y', $time);
}
?>
<!DOCTYPE html>
<html lang="<?= $currentLocale ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="<?= base_url('assets/img/assets/logo.ico') ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <title><?= esc($title) ?> - Decima</title>
    <meta name="description" content="<?= esc(substr(strip_tags($desc), 0, 160)) ?>">

    <!-- Asset CSS Persis Landing Page (Tanpa Bootstrap Icons) -->
    <link rel="stylesheet" href="<?= base_url('assets/css/style-global.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/Header.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/LandingPage.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/Footer.css') ?>">

    <!-- Open Graph SEO -->
    <meta property="og:title" content="<?= esc($title) ?>">
    <meta property="og:description" content="<?= esc(substr(strip_tags($desc), 0, 160)) ?>">
    <meta property="og:image" content="<?= $imgSrc ?>">
    <meta property="og:type" content="article">
    <meta property="og:url" content="<?= current_url() ?>">

    <script>
        const theme = localStorage.getItem('theme') || 'light';
        document.documentElement.setAttribute('data-bs-theme', theme);
    </script>

    <style>
        /* 1. Sembunyikan ikon (rumah, amplop, box) pada bottom nav agar persis landing page */
        .mobile-bottom-nav i {
            display: none !important;
        }

        /* 2. Header Statis Normal */
        header {
            position: relative !important;
            top: auto !important;
            background-color: var(--navbar-bg, #ffffff) !important;
            border-bottom: 1px solid var(--border-color, #f0f2f5) !important;
            z-index: 100 !important;
            width: 100% !important;
        }

        .logo, .logo img {
            opacity: 1 !important;
            visibility: visible !important;
            filter: none !important;
        }

        /* 3. Card Detail Portofolio */
        .static-article-card {
            background-color: var(--card-bg, #ffffff);
            border: 1px solid var(--border-color, #e2e8f0);
            border-radius: 8px;
            padding: 1.5rem;
        }

        .article-title {
            color: var(--text-main);
            font-size: clamp(1.3rem, 3.2vw, 1.8rem);
            line-height: 1.35;
            margin-top: 0.5rem;
            margin-bottom: 1rem;
        }

        .article-content {
            font-size: 0.95rem;
            line-height: 1.8;
            white-space: pre-line;
            text-align: justify;
            color: var(--text-main);
        }

        .hero-img {
            width: 100%;
            max-height: 420px;
            object-fit: cover;
            border-radius: 6px;
        }

        /* 4. Ruang Bawah Mobile agar Footer & Menu Bersih */
        @media (max-width: 767.98px) {
            body {
                padding-bottom: 85px !important;
            }

            .static-article-card {
                padding: 1.25rem;
            }
        }

        @media (min-width: 768px) {
            .static-article-card {
                padding: 2.5rem;
            }
        }
    </style>
</head>
<body>

    <!-- Header / Navbar Partial -->
    <?= $this->include('Layouts/Header') ?>

    <main class="container my-4 my-md-5">
        <div class="row justify-content-center">
            <div class="col-lg-9 col-md-11 col-12">
                
                <!-- Tombol Kembali -->
                <div class="mb-3">
                    <a href="<?= base_url('/#portofolio') ?>" class="btn-sm-custom text-decoration-none">
                        &larr; <?= $currentLocale === 'en' ? 'Back to Projects' : 'Kembali ke Portofolio' ?>
                    </a>
                </div>

                <article class="static-article-card shadow-sm">
                    <header class="mb-3">
                        <span class="badge bg-danger-subtle text-danger border border-danger-subtle px-3 py-2 rounded-pill fw-semibold">
                            📅 <?= formatTanggalDetail($date, $currentLocale) ?>
                        </span>
                        <h1 class="article-title fw-bold"><?= esc($title) ?></h1>
                    </header>

                    <div class="mb-4 overflow-hidden">
                        <img src="<?= $imgSrc ?>" alt="<?= esc($title) ?>" class="hero-img">
                    </div>

                    <div class="article-content mb-4">
                        <?= esc($desc) ?>
                    </div>

                    <hr class="my-4" style="border-color: var(--border-color);">
                    
                    <div>
                        <a href="<?= base_url('/#portofolio') ?>" class="btn-primary">
                            &larr; <?= $currentLocale === 'en' ? 'See Other Projects' : 'Lihat Proyek Lain' ?>
                        </a>
                    </div>
                </article>

            </div>
        </div>
    </main>

    <!-- Footer Partial Resmi Landing Page -->
    <?= $this->include('Layouts/Footer') ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url('assets/js/main.js') ?>"></script>
</body>
</html>