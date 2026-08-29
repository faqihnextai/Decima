<section id="about" class="about-section">
    <div class="container">
        <!-- Header Section -->
        <div class="about-header reveal-on-scroll">
            <span class="sub-heading"><?= t('About.sub_heading') ?></span>
            <h2 class="section-title"><?= t('About.name') ?></h2>
            <p class="about-lead"><?= t('About.intro') ?></p>
        </div>

        <!-- 3-Image Showcase (Asymmetrical Modern Layout) -->
        <div class="about-gallery reveal-on-scroll">
            <div class="gallery-slot slot-main">
                <img src="<?= base_url('assets/img/About/factory-1.jpg') ?>" alt="Proses Fabrikasi Pintu Besi" loading="lazy">
                <div class="img-badge">Est. <?= t('About.established') ?></div>
            </div>
            <div class="gallery-slot slot-sub slot-top">
                <img src="<?= base_url('assets/img/About/factory-2.jpg') ?>" alt="Instalasi Pintu Baja Industri" loading="lazy">
            </div>
            <div class="gallery-slot slot-sub slot-bottom">
                <img src="<?= base_url('assets/img/About/factory-3.jpg') ?>" alt="Quality Control Presisi" loading="lazy">
            </div>
        </div>

        <!-- Visi & Misi Streamline -->
        <div class="about-pillars reveal-on-scroll">
            <div class="pillar-row">
                <span class="pillar-tag"><?= t('About.vision_tag') ?></span>
                <p class="pillar-quote">“<?= t('About.vision') ?>”</p>
            </div>
            <div class="pillar-row">
                <span class="pillar-tag"><?= t('About.mission_tag') ?></span>
                <p class="pillar-quote">“<?= t('About.mission') ?>”</p>
            </div>
        </div>

        <!-- Filosofi Perusahaan -->
        <div class="about-philosophy reveal-on-scroll">
            <h3 class="philosophy-title"><?= t('About.philo_title') ?></h3>
            <div class="philosophy-list">
                <div class="philosophy-item">
                    <span class="bullet-accent"></span>
                    <div class="philosophy-text">
                        <strong><?= t('About.philo_1_title') ?></strong>
                        <p><?= t('About.philo_1_desc') ?></p>
                    </div>
                </div>

                <div class="philosophy-item">
                    <span class="bullet-accent"></span>
                    <div class="philosophy-text">
                        <strong><?= t('About.philo_2_title') ?></strong>
                        <p><?= t('About.philo_2_desc') ?></p>
                    </div>
                </div>

                <div class="philosophy-item">
                    <span class="bullet-accent"></span>
                    <div class="philosophy-text">
                        <strong><?= t('About.philo_3_title') ?></strong>
                        <p><?= t('About.philo_3_desc') ?></p>
                    </div>
                </div>

                <div class="philosophy-item">
                    <span class="bullet-accent"></span>
                    <div class="philosophy-text">
                        <strong><?= t('About.philo_4_title') ?></strong>
                        <p><?= t('About.philo_4_desc') ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>