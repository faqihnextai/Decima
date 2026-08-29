<section id="product" class="product-section">
    <div class="container">
        <div class="section-header reveal-on-scroll">
            <span class="sub-heading"><?= t('Product.section_tag') ?></span>
            <h2 class="section-title"><?= t('Product.section_title') ?></h2>
            <p class="section-desc"><?= t('Product.section_desc') ?></p>
        </div>

        <div class="product-stream">
            <?= $this->include('landing/product/SINGLE-FIRE-DOOR') ?>
            <?= $this->include('landing/product/DOUBLE-FIRE-DOOR') ?>
            <?= $this->include('landing/product/STEEL-SINGLE-DOOR') ?>
            <?= $this->include('landing/product/STEEL-AIRTIGHT-DOOR') ?>
            <?= $this->include('landing/product/STEEL-BLAST-DOOR') ?>
            <?= $this->include('landing/product/STEEL-LOUVER-DOOR') ?>
            <?= $this->include('landing/product/STEEL-RADIATION-DOOR') ?>
            <?= $this->include('landing/product/STEEL-SHAFT-DOOR') ?>
        </div>
    </div>
</section>