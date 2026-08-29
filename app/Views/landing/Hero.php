<section id="hero" class="hero-section">
    <!-- Area Media Atas (Video + Overlay Judul) -->
    <div class="hero-media-container">
        <div class="door-wrapper">
            <video id="heroVideo" autoplay muted playsinline preload="auto">
                <source src="<?= base_url('assets/img/hero/hero.webm') ?>" type="video/webm">
                Browser Anda tidak mendukung tag video.
            </video>
            <img id="heroSlide" class="hero-slide-img" src="<?= base_url('assets/img/hero/frame1.jpg') ?>" alt="Slide Hero" style="display: none;">
        </div>

        <div class="hero-media-overlay">
            <div class="hero-company hero-text delay-company">
                <?= t('Hero.company') ?>
            </div>
            <h1 class="hero-text delay-title">
                <?= t('Hero.title') ?>
            </h1>
        </div>
    </div>

    <!-- Area Konten Bawah (Deskripsi & Tombol di Bawah Video) -->
    <div class="hero-bottom-area">
        <p class="hero-desc hero-text delay-desc">
            <?= t('Hero.description') ?>
        </p>
        <div class="hero-btn-wrap hero-text delay-btn">
            <a href="#contact" class="btn-primary">
                <?= t('Hero.btn_contact') ?>
            </a>
        </div>
    </div>
</section>