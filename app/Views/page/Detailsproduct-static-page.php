<?php
helper('url');
$currentLocale = session()->get('locale') ?? 'id';

$title = ($currentLocale === 'en' && !empty($product['title_en'])) ? $product['title_en'] : $product['title'];
$lead  = ($currentLocale === 'en' && !empty($product['lead_en'])) ? $product['lead_en'] : $product['lead'];
$mainImg = !empty($product['images']['main']) ? base_url($product['images']['main']) : base_url('assets/img/product/single-fire-door.jpg');
?>
<!DOCTYPE html>
<html lang="<?= $currentLocale ?>">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="<?= base_url('assets/img/assets/logo.ico') ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <title><?= esc($title) ?> - Decima Door Specifications</title>
    <meta name="description" content="<?= esc(substr(strip_tags($lead), 0, 160)) ?>">

    <!-- Asset CSS Global & Components -->
    <link rel="stylesheet" href="<?= base_url('assets/css/style-global.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/Header.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/LandingPage.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/Footer.css') ?>">

    <!-- Open Graph SEO -->
    <meta property="og:title" content="<?= esc($title) ?> - Decima Specifications">
    <meta property="og:description" content="<?= esc(substr(strip_tags($lead), 0, 160)) ?>">
    <meta property="og:image" content="<?= $mainImg ?>">
    <meta property="og:type" content="product">
    <meta property="og:url" content="<?= current_url() ?>">

    <script>
    const theme = localStorage.getItem('theme') || 'light';
    document.documentElement.setAttribute('data-bs-theme', theme);
    </script>

    <style>
    .spec-card-container {
        background-color: var(--card-bg, #ffffff);
        border: 1px solid var(--border-color, #e2e8f0);
        border-radius: 12px;
        padding: 2rem;
    }

    .spec-table-box {
        display: flex;
        flex-direction: column;
        gap: 1.25rem;
        margin-top: 1.5rem;
    }

    .spec-item {
        background: var(--bg-alt, #f8fafc);
        border: 1px solid var(--border-color, #cbd5e1);
        border-radius: 8px;
        padding: 1.2rem 1.4rem;
    }

    .spec-item h5 {
        font-size: 1rem;
        font-weight: 700;
        color: var(--primary-color);
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .spec-item p {
        font-size: 0.94rem;
        line-height: 1.7;
        margin-bottom: 0;
        color: var(--text-main);
    }

    .blueprint-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
        gap: 1rem;
        margin-top: 1rem;
    }

    .blueprint-box {
        border: 1px dashed var(--border-color);
        border-radius: 8px;
        overflow: hidden;
        background: var(--bg-alt);
        aspect-ratio: 4 / 3;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .blueprint-box img {
        width: 100%;
        height: 100%;
        object-fit: contain;
        transition: transform 0.3s ease;
    }

    .blueprint-box:hover img {
        transform: scale(1.05);
    }

    .config-grid {
        display: flex;
        gap: 1.25rem;
        flex-wrap: wrap;
        margin-top: 1rem;
    }

    .config-item {
        flex: 1 1 120px;
        max-width: 160px;
        text-align: center;
        border: 1px solid var(--border-color);
        border-radius: 8px;
        padding: 0.75rem;
        background: var(--bg-alt);
    }

    .config-img-box {
        height: 160px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 0.5rem;
    }

    .config-img-box img {
        max-width: 100%;
        max-height: 100%;
        object-fit: contain;
    }

    .config-label {
        font-weight: 700;
        font-size: 0.9rem;
        color: var(--text-main);
    }

    @media (max-width: 768px) {
        .spec-card-container {
            padding: 1.25rem;
        }

        body {
            padding-bottom: 85px !important;
        }
    }
    </style>
</head>

<body>

    <!-- Header / Navbar Partial -->
    <?= $this->include('Layouts/Header') ?>

    <main class="container my-4 my-md-5">
        <div class="row justify-content-center">
            <div class="col-lg-10 col-12">

                <article class="spec-card-container shadow-sm">
                    <!-- Title & Header -->
                    <div class="row align-items-center g-4 pb-4 border-bottom"
                        style="border-color: var(--border-color) !important;">
                        <div class="col-md-5 text-center">
                            <div class="position-relative overflow-hidden rounded-3 border"
                                style="border-color: var(--border-color) !important; max-height: 380px;">
                                <img src="<?= $mainImg ?>" alt="<?= esc($title) ?>" class="w-100 h-100 object-fit-cover"
                                    onerror="this.src='https://placehold.co/400x500?text=Product+Photo'">
                            </div>
                        </div>
                        <div class="col-md-7">
                            <span class="badge bg-primary px-3 py-2 rounded-pill fw-semibold mb-2">DECIMA
                                SPECIFICATION</span>
                            <h1 class="fw-bold mb-2" style="color: var(--text-main);"><?= esc($title) ?></h1>
                            <p class="lead fs-6 text-muted mb-4"><?= esc($lead) ?></p>
                            <a href="<?= base_url('/#contact') ?>" class="btn-primary">
                                <i class="bi bi-telephone-outbound me-1"></i>
                                <?= $currentLocale === 'en' ? 'Request Official Quotation' : 'Minta Penawaran Resmi' ?>
                            </a>
                        </div>
                    </div>

                    <!-- 4 Point Technical Specification -->
                    <div class="my-4">
                        <h4 class="fw-bold" style="color: var(--text-main);"><i
                                class="bi bi-file-earmark-ruled me-2"></i><?= $currentLocale === 'en' ? 'Technical Specifications' : 'Spesifikasi Teknis Lengkap' ?>
                        </h4>
                        <div class="spec-table-box">
                            <!-- 1. Door Frame -->
                            <div class="spec-item">
                                <h5><i class="bi bi-bounding-box-circles"></i> Door Frame</h5>
                                <p><?= esc($product['door_frame'] ?? '-') ?></p>
                            </div>

                            <!-- 2. Door Leaf -->
                            <div class="spec-item">
                                <h5><i class="bi bi-door-closed"></i> Door Leaf / Blade</h5>
                                <p><?= esc($product['door_leaf'] ?? '-') ?></p>
                            </div>

                            <!-- 3. Optional -->
                            <div class="spec-item">
                                <h5><i class="bi bi-plus-square"></i> Optional Hardware & Glass</h5>
                                <p><?= esc($product['optional'] ?? '-') ?></p>
                            </div>

                            <!-- 4. Finishing -->
                            <div class="spec-item">
                                <h5><i class="bi bi-paint-bucket"></i> Finishing</h5>
                                <p><?= esc($product['finishing'] ?? '-') ?></p>
                            </div>
                        </div>
                    </div>

                    <hr class="my-4" style="border-color: var(--border-color);">

                    <!-- Blueprint Technical Gallery (1 - 6) -->
                    <div class="my-4">
                        <h4 class="fw-bold" style="color: var(--text-main);"><i
                                class="bi bi-diagram-3 me-2"></i><?= $currentLocale === 'en' ? 'Technical Drawings & Blueprints' : 'Gambar Teknis & Detail Blueprint' ?>
                        </h4>
                        <div class="blueprint-grid">
                            <?php 
                            $blueprints = $product['images']['blueprints'] ?? [];
                            for ($i = 0; $i < 6; $i++): 
                                $bpSrc = !empty($blueprints[$i]) ? base_url($blueprints[$i]) : "https://placehold.co/400x300?text=Blueprint+" . ($i + 1);
                            ?>
                            <div class="blueprint-box">
                                <img src="<?= $bpSrc ?>" alt="Blueprint <?= $i + 1 ?>" loading="lazy"
                                    onerror="this.src='https://placehold.co/400x300?text=Blueprint+<?= $i + 1 ?>'">
                            </div>
                            <?php endfor; ?>
                        </div>
                    </div>

                    <hr class="my-4" style="border-color: var(--border-color);">

                    <!-- Typical Configurations (F, V, NS, NH / FL, BL, dll) -->
                    <?php if (!empty($product['images']['configurations'])): ?>
                    <div class="my-4">
                        <h4 class="fw-bold" style="color: var(--text-main);"><i
                                class="bi bi-grid me-2"></i><?= $currentLocale === 'en' ? 'Typical Configurations' : 'Konfigurasi Tipikal' ?>
                        </h4>
                        <div class="config-grid">
                            <?php foreach ($product['images']['configurations'] as $cfgName => $cfgImg): 
                                $cfgSrc = !empty($cfgImg) ? base_url($cfgImg) : "https://placehold.co/200x300?text=" . $cfgName;
                            ?>
                            <div class="config-item">
                                <div class="config-img-box">
                                    <img src="<?= $cfgSrc ?>" alt="Config <?= esc($cfgName) ?>" loading="lazy"
                                        onerror="this.src='https://placehold.co/200x300?text=<?= esc($cfgName) ?>'">
                                </div>
                                <div class="config-label"><?= esc($cfgName) ?></div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <?php endif; ?>

                    <hr class="my-4" style="border-color: var(--border-color);">

                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                        <!-- Menggunakan base_url langsung ke root -->
                        <a href="<?= base_url() ?>#product" class="btn-sm-custom text-decoration-none">
                            &larr; <?= $currentLocale === 'en' ? 'Explore All Doors' : 'Lihat Produk Lainnya' ?>
                        </a>
                        <a href="<?= base_url() ?>#contact" class="btn-primary">
                            <?= $currentLocale === 'en' ? 'Contact Sales Engineer' : 'Hubungi Sales Engineer' ?>
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
    <script src="<?= base_url('assets/js/header.js') ?>"></script>
</body>

</html>