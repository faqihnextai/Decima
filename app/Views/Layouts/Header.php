<!-- 1. FLOATING LOGO MANDIRI (Melayang murni di Mobile, di Desktop sejajar di pojok kiri) -->
<a href="<?= base_url() ?>" class="floating-brand-logo" id="floatingBrandLogo" aria-label="Home">
    <img src="<?= base_url('assets/img/assets/logo.png') ?>" alt="Logo Brand">
</a>

<!-- 2. HEADER NAVBAR (Khusus Desktop) -->
<header class="desktop-header-bar" id="desktopHeaderBar">
    <div class="desktop-nav-container">
        <!-- Spacer Kiri agar menu navigasi tidak menabrak Logo -->
        <div class="logo-desktop-spacer"></div>

        <!-- Menu Navigasi Desktop -->
        <nav class="nav-links-desktop">
            <a href="<?= base_url('/#about') ?>" class="nav-item-link">
                <?= function_exists('t') ? t('Nav.about') : 'Tentang Kami' ?>
            </a>
            
            <!-- Dropdown Produk Desktop -->
            <div class="dropdown-product-wrapper">
                <button type="button" class="desktop-product-btn" onclick="toggleDesktopDropdown(event)">
                    <span><?= function_exists('t') ? t('Nav.product') : 'Produk' ?></span>
                    <i class="bi bi-chevron-down dropdown-arrow"></i>
                </button>
                <div class="desktop-dropdown-menu" id="desktopProductMenu">
                    <a href="<?= base_url('/#prod-single-fire-door') ?>"><span class="drop-idx">01</span> Single Fire Door</a>
                    <a href="<?= base_url('/#prod-double-fire-door') ?>"><span class="drop-idx">02</span> Double Fire Door</a>
                    <a href="<?= base_url('/#prod-steel-single-door') ?>"><span class="drop-idx">03</span> Steel Single Door</a>
                    <a href="<?= base_url('/#prod-steel-airtight-door') ?>"><span class="drop-idx">04</span> Steel Airtight Door</a>
                    <a href="<?= base_url('/#prod-steel-blast-door') ?>"><span class="drop-idx">05</span> Steel Blast Door</a>
                    <a href="<?= base_url('/#prod-steel-louver-door') ?>"><span class="drop-idx">06</span> Steel Louver Door</a>
                    <a href="<?= base_url('/#prod-steel-radiation-door') ?>"><span class="drop-idx">07</span> Steel Radiation Door</a>
                    <a href="<?= base_url('/#prod-steel-shaft-door') ?>"><span class="drop-idx">08</span> Steel Shaft Door</a>
                </div>
            </div>

            <a href="<?= base_url('/#portofolio') ?>" class="nav-item-link">
                <?= function_exists('t') ? t('Nav.portofolio') : 'Portofolio' ?>
            </a>
            <a href="<?= base_url('/#client') ?>" class="nav-item-link">
                <?= function_exists('t') ? t('Nav.client') : 'Klien' ?>
            </a>
            <a href="<?= base_url('/#contact') ?>" class="nav-item-link">
                <?= function_exists('t') ? t('Nav.contact') : 'Kontak' ?>
            </a>

            <!-- Language & Dark Mode Switcher Desktop -->
            <div class="lang-switch-desktop">
                <a href="<?= base_url('lang/en') ?>" class="<?= (session()->get('locale') ?? 'id') === 'en' ? 'active-lang' : '' ?>">EN</a>
                <span class="divider">|</span>
                <a href="<?= base_url('lang/id') ?>" class="<?= (session()->get('locale') ?? 'id') === 'id' ? 'active-lang' : '' ?>">ID</a>
                <span class="divider">|</span>
                <button type="button" class="theme-toggle-btn" onclick="toggleTheme()" aria-label="Ganti Tema">
                    <span class="theme-icon">🌙</span>
                </button>
            </div>
        </nav>
    </div>
</header>

<!-- 3. FLOATING BUBBLE ID/EN & THEME (Melayang di Mobile Kanan Bawah) -->
<div class="mobile-floating-bubble" id="mobileFloatingBubble">
    <a href="<?= base_url('lang/en') ?>" class="<?= (session()->get('locale') ?? 'id') === 'en' ? 'active' : '' ?>">EN</a>
    <span class="bubble-sep">/</span>
    <a href="<?= base_url('lang/id') ?>" class="<?= (session()->get('locale') ?? 'id') === 'id' ? 'active' : '' ?>">ID</a>
    <span class="bubble-sep">/</span>
    <button type="button" class="theme-toggle-btn-bubble" onclick="toggleTheme()" aria-label="Ganti Tema">
        <span class="theme-icon">🌙</span>
    </button>
</div>

<!-- 4. BOTTOM NAVIGATION BAR (Khusus Mobile di Dasar Layar) -->
<nav class="mobile-bottom-bar" id="mobileBottomBar">
    <a href="<?= base_url('/#contact') ?>" class="mobile-bottom-nav" onclick="setActiveNav(this)">
        <i class="bi bi-envelope"></i>
        <span><?= function_exists('t') ? t('Nav.contact') : 'Kontak' ?></span>
    </a>
    <a href="<?= base_url('/#about') ?>" class="mobile-bottom-nav" onclick="setActiveNav(this)">
        <i class="bi bi-house-door"></i>
        <span><?= function_exists('t') ? t('Nav.about') : 'Tentang Kami' ?></span>
    </a>
    <a href="javascript:void(0)" class="mobile-bottom-nav" onclick="openMobileProductSheet(this)">
        <i class="bi bi-box-seam"></i>
        <span><?= function_exists('t') ? t('Nav.product') : 'Produk' ?></span>
    </a>
</nav>

<!-- 5. MOBILE BOTTOM SHEET (Modal Sliding Up List Produk) -->
<div class="mobile-product-overlay" id="mobileProductOverlay" onclick="closeMobileProductSheet()"></div>
<div class="mobile-product-sheet" id="mobileProductSheet">
    <div class="mobile-sheet-header">
        <div class="mobile-sheet-pill"></div>
        <div class="d-flex justify-content-between align-items-center mt-2 px-1">
            <h6 class="fw-bold mb-0 text-main"><?= function_exists('t') ? t('Nav.product') : 'Daftar Produk Pintu' ?></h6>
            <button type="button" class="btn-close-sheet" onclick="closeMobileProductSheet()">&times;</button>
        </div>
    </div>
    <div class="mobile-sheet-body">
        <a href="<?= base_url('/#prod-single-fire-door') ?>" onclick="closeMobileProductSheet()"><span class="sheet-idx">01</span> Single Fire Door</a>
        <a href="<?= base_url('/#prod-double-fire-door') ?>" onclick="closeMobileProductSheet()"><span class="sheet-idx">02</span> Double Fire Door</a>
        <a href="<?= base_url('/#prod-steel-single-door') ?>" onclick="closeMobileProductSheet()"><span class="sheet-idx">03</span> Steel Single Door</a>
        <a href="<?= base_url('/#prod-steel-airtight-door') ?>" onclick="closeMobileProductSheet()"><span class="sheet-idx">04</span> Steel Airtight Door</a>
        <a href="<?= base_url('/#prod-steel-blast-door') ?>" onclick="closeMobileProductSheet()"><span class="sheet-idx">05</span> Steel Blast Door</a>
        <a href="<?= base_url('/#prod-steel-louver-door') ?>" onclick="closeMobileProductSheet()"><span class="sheet-idx">06</span> Steel Louver Door</a>
        <a href="<?= base_url('/#prod-steel-radiation-door') ?>" onclick="closeMobileProductSheet()"><span class="sheet-idx">07</span> Steel Radiation Door</a>
        <a href="<?= base_url('/#prod-steel-shaft-door') ?>" onclick="closeMobileProductSheet()"><span class="sheet-idx">08</span> Steel Shaft Door</a>
    </div>
</div>