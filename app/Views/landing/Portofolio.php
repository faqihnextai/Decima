<?php
helper('url');
$jsonPath = WRITEPATH . 'data/portfolios.json';
$portfolios = file_exists($jsonPath) ? json_decode(file_get_contents($jsonPath), true) : [];
$currentLocale = session()->get('locale') ?? 'id';

if (!function_exists('formatTanggalPortfolio')) {
    function formatTanggalPortfolio($dateStr, $locale = 'id') {
        if (empty($dateStr)) return date('d M Y');
        $time = strtotime($dateStr);
        
        if ($locale === 'en') {
            return date('l, d F Y', $time);
        }

        $hari = ['Sunday' => 'Minggu', 'Monday' => 'Senin', 'Tuesday' => 'Selasa', 'Wednesday' => 'Rabu', 'Thursday' => 'Kamis', 'Friday' => 'Jumat', 'Saturday' => 'Sabtu'];
        $bulan = [1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        
        $namaHari = $hari[date('l', $time)] ?? '';
        $tgl = date('d', $time);
        $namaBulan = $bulan[(int)date('m', $time)] ?? '';
        $tahun = date('Y', $time);

        return "$namaHari, $tgl $namaBulan $tahun";
    }
}
?>

<section id="portofolio" class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="section-title fw-bold"><?= $currentLocale === 'en' ? 'Portfolio & Project News' : 'Portofolio & Berita Proyek' ?></h2>
            <p class="section-desc text-muted">
                <?= $currentLocale === 'en' ? 'Documentation of our work and installation news across project sites.' : 'Dokumentasi hasil pengerjaan dan berita instalasi di berbagai lokasi proyek.' ?>
            </p>
        </div>

        <?php if (!empty($portfolios)): ?>
            <div id="portfolioNewsCarousel" class="carousel slide rounded-4 overflow-hidden" data-bs-ride="carousel">
                <div class="carousel-indicators mb-2">
                    <?php foreach ($portfolios as $idx => $item): ?>
                        <button type="button" data-bs-target="#portfolioNewsCarousel" data-bs-slide-to="<?= $idx ?>" class="<?= $idx === 0 ? 'active' : '' ?>" aria-current="<?= $idx === 0 ? 'true' : 'false' ?>" aria-label="Slide <?= $idx + 1 ?>"></button>
                    <?php endforeach; ?>
                </div>

                <div class="carousel-inner">
                    <?php foreach ($portfolios as $idx => $item): 
                        $activeTitle = ($currentLocale === 'en' && !empty($item['title_en'])) ? $item['title_en'] : $item['title'];
                        $activeDesc  = ($currentLocale === 'en' && !empty($item['description_en'])) ? $item['description_en'] : $item['description'];
                        $slug = mb_url_title($activeTitle, '-', true);
                        $detailUrl = base_url('portofolio/' . $slug);
                    ?>
                        <div class="carousel-item <?= $idx === 0 ? 'active' : '' ?>" data-bs-interval="6000">
                            <div class="p-4 p-md-5">
                                <div class="border-bottom pb-3 mb-4" style="border-color: var(--border-color) !important;">
                                    <div class="d-flex align-items-center gap-2 mb-2">
                                        <span class="badge bg-danger-subtle text-danger border border-danger-subtle px-3 py-2 rounded-pill fw-semibold">
                                            📅 <?= formatTanggalPortfolio($item['date'] ?? $item['created_at'] ?? '', $currentLocale) ?>
                                        </span>
                                    </div>
                                    <h3 class="fw-bold mb-0" style="color: var(--text-main);"><?= esc($activeTitle) ?></h3>
                                </div>

                                <div class="row align-items-center g-4">
                                    <div class="col-lg-7 col-md-6 order-2 order-md-1">
                                        <div class="pe-md-3">
                                            <p class="lead fs-6 mb-4" style="text-align: justify; line-height: 1.7; color: var(--text-muted);">
                                                <?php 
                                                    $descClean = esc($activeDesc);
                                                    echo (strlen($descClean) > 230) ? substr($descClean, 0, 230) . '...' : $descClean;
                                                ?>
                                            </p>
                                            <a href="<?= $detailUrl ?>" class="btn-primary">
                                                <?= $currentLocale === 'en' ? 'Read More &rarr;' : 'Selengkapnya &rarr;' ?>
                                            </a>
                                        </div>
                                    </div>

                                    <div class="col-lg-5 col-md-6 order-1 order-md-2">
                                        <div class="position-relative overflow-hidden rounded-4 shadow-sm" style="height: 280px; border: var(--silhouette-border);">
                                            <?php 
                                                $imgSrc = !empty($item['image']) 
                                                    ? base_url('uploads/portfolio/' . $item['image']) 
                                                    : 'https://images.unsplash.com/photo-1541888946425-d0fbb18086f6?w=600&auto=format&fit=crop&q=80';
                                            ?>
                                            <img src="<?= $imgSrc ?>" alt="<?= esc($activeTitle) ?>" class="w-100 h-100 object-fit-cover">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <button class="carousel-control-prev" type="button" data-bs-target="#portfolioNewsCarousel" data-bs-slide="prev" style="width: 5%;">
                    <span class="carousel-control-prev-icon bg-dark bg-opacity-50 rounded-circle p-3" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#portfolioNewsCarousel" data-bs-slide="next" style="width: 5%;">
                    <span class="carousel-control-next-icon bg-dark bg-opacity-50 rounded-circle p-3" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        <?php else: ?>
            <div class="text-center py-5 rounded-4" style="background-color: var(--card-bg); border: var(--silhouette-border);">
                <p class="text-muted mb-0"><?= $currentLocale === 'en' ? 'No portfolio/news published yet.' : 'Belum ada berita / portofolio yang dipublikasikan.' ?></p>
            </div>
        <?php endif; ?>
    </div>
</section>