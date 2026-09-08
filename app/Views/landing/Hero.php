<section id="hero" class="hero-section">
    <!-- Media Video Background -->
    <div class="hero-media-container">
        <div class="door-wrapper">
            <video id="heroVideo" autoplay muted playsinline preload="auto">
                <source src="<?= base_url('assets/img/hero/hero.webm') ?>" type="video/webm">
                Browser Anda tidak mendukung tag video.
            </video>
            <img id="heroSlide" class="hero-slide-img" src="<?= base_url('assets/img/hero/frame1.jpg') ?>" alt="Slide Hero" style="display: none;">
        </div>

        <!-- Overlay Text Container (Rata Kiri Penuh) -->
        <div class="hero-media-overlay hero-align-left">
            <div class="hero-brand-stage hero-text delay-title">
                <!-- Laser Accent Line -->
                <div class="brand-laser-line"></div>

                <div class="brand-content-flow">
                    <!-- 1. DECIMA (Paling Atas & Gede) -->
                    <h1 class="brand-decima-title">
                        <span class="text-steel-plasma"><?= t('Hero.brand') ?></span>
                    </h1>

                    <!-- 2. MANUFACTURING BY (Sekarang di bawah DECIMA) -->
                    <div class="brand-kicker">
                        <span class="pulse-beacon"></span>
                        <span class="connector-txt"><?= t('Hero.connector') ?></span>
                    </div>

                    <!-- 3. CV. CIPTA SARANA PRIMA -->
                    <div class="brand-vendor-block">
                        <span class="vendor-txt"><?= t('Hero.vendor') ?></span>
                    </div>

                    <!-- 4. Subtagline Konstruksi -->
                    <p class="brand-sub-catch">
                        <?= t('Hero.title') ?>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Bottom Area -->
    <div class="hero-bottom-area">
        <p class="hero-subtagline hero-text delay-desc">
            <?= t('Hero.subtagline') ?>
        </p>
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