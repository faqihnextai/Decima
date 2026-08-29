<?php
$clients = [
    ['img' => 'asia_phone.jpg', 'name' => 'Asia Phone'],
    ['img' => 'best_western.png', 'name' => 'Best Western'],
    ['img' => 'cbc.jpg', 'name' => 'CBC'],
    ['img' => 'cinemaflix_district.png', 'name' => 'Cinemaflix District'],
    ['img' => 'download.jpg', 'name' => 'Partner'],
    ['img' => 'download1.jpg', 'name' => 'Partner 2'],
    ['img' => 'indogrosir.png', 'name' => 'Indogrosir'],
    ['img' => 'mayora.png', 'name' => 'Mayora'],
    ['img' => 'nava_park.png', 'name' => 'Nava Park'],
    ['img' => 'pltu_bengkulu.jpg', 'name' => 'PLTU Bengkulu'],
    ['img' => 'rs_dr_yati.png', 'name' => 'RS Dr. Yati'],
    ['img' => 'rs_persahabatan.jpg', 'name' => 'RS Persahabatan'],
    ['img' => 'sinar_mas.jpg', 'name' => 'Sinar Mas'],
    ['img' => 'tanah_abang.png', 'name' => 'Tanah Abang'],
    ['img' => 'Vimala-Hills-logo.png', 'name' => 'Vimala Hills'],
];
?>

<section id="client" class="py-5">
    <div class="container text-center">
        <!-- Judul & Deskripsi Bilingual ID | EN -->
        <h2 class="section-title fw-bold">
            <?= function_exists('t') ? t('Client.title') : 'Klien & Mitra Kami' ?>
        </h2>
        <p class="section-desc text-muted mb-4">
            <?= function_exists('t') ? t('Client.desc') : 'Dipercaya oleh berbagai perusahaan terkemuka, fasilitas kesehatan, dan proyek nasional.' ?>
        </p>

        <!-- Slider Marquee Desktop & Grid Responsif Mobile -->
        <div class="client-marquee-wrapper">
            <div class="client-marquee-track">
                <!-- Looping Pertama -->
                <?php foreach ($clients as $client): ?>
                    <div class="client-logo-item">
                        <img src="<?= base_url('assets/img/clients/' . $client['img']) ?>" alt="<?= esc($client['name']) ?>" loading="lazy">
                    </div>
                <?php endforeach; ?>

                <!-- Looping Gandum (Duplikat khusus agar looping marquee desktop mulus tanpa jeda) -->
                <?php foreach ($clients as $client): ?>
                    <div class="client-logo-item desktop-dup">
                        <img src="<?= base_url('assets/img/clients/' . $client['img']) ?>" alt="<?= esc($client['name']) ?>" loading="lazy">
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>