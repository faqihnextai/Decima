<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="<?= base_url('assets/img/assets/logo.ico') ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>Decima - Door steel for industrial</title>
   <!-- Panggilan CSS yang benar dari folder public -->
    <link rel="stylesheet" href="<?= base_url('assets/css/style-global.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/Header.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/LandingPage.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/AboutUs.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/Product.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/Footer.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/buble-pdf.css') ?>">
    <script>
        const theme = localStorage.getItem('theme') || 'light';
        document.documentElement.setAttribute('data-bs-theme', theme);
    </script>
    </head>
<body>

    <!-- Header / Navbar Partial -->
    <?= $this->include('Layouts/Header') ?>

    <main>
        <?= $this->include('landing/Hero') ?>
        <?= $this->include('landing/AboutUs') ?>
        <?= $this->include('landing/Product') ?>
        <?= $this->include('landing/Portofolio') ?>
        <?= $this->include('landing/RecentClient') ?>
        <?= $this->include('landing/Contact') ?>
    </main>

    <!-- Footer Partial -->
    <?= $this->include('Layouts/Footer') ?>

    <!-- <script>
        const menuToggle = document.getElementById('menuToggle');
        const navLinks = document.getElementById('navLinks');

        menuToggle.addEventListener('click', () => {
            navLinks.classList.toggle('active');
        });
    </script> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url('assets/js/main.js') ?>"></script>
    <script src="<?= base_url('assets/js/header.js') ?>"></script>
    <script src="<?= base_url('assets/js/buble-pdf.js') ?>"></script>
</body>
</html>