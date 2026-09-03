<div id="prod-steel-blast-door" class="product-item reveal-on-scroll">
    <div class="product-media">
        <div class="door-frame-box">
            <img src="<?= base_url('assets/img/product/steel-blast-door.jpg') ?>" alt="<?= t('Product.sbd_title') ?>" loading="lazy">
            <span class="product-badge"><?= t('Product.sbd_badge') ?></span>
        </div>
    </div>
    <div class="product-detail">
        <span class="product-index">05</span>
        <div class="product-header-toggle" onclick="toggleProductSlider(this)">
            <h3 class="product-title"><?= t('Product.sbd_title') ?></h3>
            <span class="toggle-indicator"><i class="bi bi-chevron-down"></i></span>
        </div>
        <p class="product-lead"><?= t('Product.sbd_lead') ?></p>
        
        <div class="product-slider-content">
            <div class="hook-box">
                <div class="hook-point hook-punch">
                    <span class="hook-icon">⚡</span>
                    <div class="hook-content">
                        <strong class="hook-label"><?= t('Product.lbl_hook') ?></strong>
                        <p class="hook-text"><?= t('Product.sbd_hook') ?></p>
                    </div>
                </div>
                <div class="hook-point hook-industry">
                    <span class="hook-icon">🏢</span>
                    <div class="hook-content">
                        <strong class="hook-label"><?= t('Product.lbl_industry') ?></strong>
                        <p class="hook-text"><?= t('Product.sbd_industry') ?></p>
                    </div>
                </div>
                <div class="hook-point hook-material">
                    <span class="hook-icon">🛡️</span>
                    <div class="hook-content">
                        <strong class="hook-label"><?= t('Product.lbl_material') ?></strong>
                        <p class="hook-text"><?= t('Product.sbd_material') ?></p>
                    </div>
                </div>
            </div>

            <div class="product-action-group">
                <a href="<?= base_url('product/steel-blast-door') ?>" class="btn-product-detail"><?= t('Product.btn_detail') ?> &rarr;</a>
                <a href="#contact" class="btn-product-consult"><?= t('Product.btn_consult') ?></a>
            </div>
        </div>
    </div>
</div>