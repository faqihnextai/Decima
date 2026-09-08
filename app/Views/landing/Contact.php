<section id="contact">
    <div class="container">
        <h2 class="section-title"><?= t('Contact.title') ?></h2>
        <p class="section-desc"><?= t('Contact.subtitle') ?></p>

        <!-- Flash Message Status Pengiriman -->
        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success">
                <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger">
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>

        <form action="<?= base_url('contact/send') ?>" method="post" class="contact-form">
            <?= csrf_field() ?>

            <input type="text" name="name" value="<?= old('name') ?>" placeholder="<?= t('Contact.name_placeholder') ?>" required>
            <input type="email" name="email" value="<?= old('email') ?>" placeholder="<?= t('Contact.email_placeholder') ?>" required>
            <textarea name="message" rows="4" placeholder="<?= t('Contact.msg_placeholder') ?>" required><?= old('message') ?></textarea>
            
            <button type="submit" class="btn-primary"><?= t('Contact.btn_submit') ?></button>
        </form>
    </div>
</section>