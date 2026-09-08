<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="<?= base_url('assets/img/assets/logo.ico') ?>">
    <title>Kelola Berita Portofolio - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('assets/css/admin.css') ?>">
</head>
<body class="bg-surface">
    <div class="container-fluid px-3 px-md-4 py-3 py-md-4">
        <!-- Top Navbar Berwarna & Responsif -->
        <header class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-3 mb-4 bg-white p-3 shadow-sm top-nav">
            <div>
                <h4 class="fw-bold mb-0 text-dark">Kelola Berita & Portofolio</h4>
                <small class="text-secondary">Penyimpanan murni berbasis File JSON</small>
            </div>
            <div class="d-flex gap-2">
                <a href="<?= base_url('/') ?>" target="_blank" class="btn btn-outline-secondary btn-sm flex-fill flex-sm-grow-0 d-inline-flex align-items-center justify-content-center gap-1">
                    <i class="bi bi-box-arrow-up-right"></i> Landing Page
                </a>
                <a href="<?= base_url('logout') ?>" class="btn btn-outline-danger btn-sm flex-fill flex-sm-grow-0 d-inline-flex align-items-center justify-content-center gap-1">
                    <i class="bi bi-box-arrow-right"></i> Logout
                </a>
            </div>
        </header>

        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i><?= session()->getFlashdata('success') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <div class="row g-4">
            <!-- Form Input / Edit Card -->
            <div class="col-12 col-xl-4 col-lg-5">
                <div class="card admin-card border-0 shadow-sm overflow-hidden">
                    <div class="card-header gradient-header-primary py-3">
                        <h5 class="card-title mb-0 fs-6 fw-bold text-white" id="formTitle">Tambah Berita / Proyek</h5>
                    </div>
                    <div class="card-body p-3 p-md-4">
                        <form action="<?= base_url('admin/portfolio/save') ?>" method="post" enctype="multipart/form-data" id="portfolioForm">
                            <?= csrf_field() ?>
                            <input type="hidden" name="id" id="portfolioId">
                            <input type="hidden" name="existing_image" id="portfolioExistingImage">
                            <input type="hidden" name="image_position" id="portfolioImagePosition" value="center">

                            <div class="mb-3">
                                <label class="form-label fw-semibold text-dark">Judul Berita / Proyek</label>
                                <input type="text" name="title" id="portfolioTitle" class="form-control" placeholder="Contoh: Instalasi Steel Door Gedung A" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold text-dark">Tanggal Berita / Proyek</label>
                                <input type="date" name="date" id="portfolioDate" class="form-control" value="<?= date('Y-m-d') ?>" required>
                            </div>

                            <!-- Opsi Ambil Foto: Kamera atau File HP/PC -->
                            <div class="mb-3">
                                <label class="form-label fw-semibold text-dark">Foto Dokumentasi</label>
                                <div class="d-flex gap-2 mb-2">
                                    <button type="button" class="btn btn-camera-opt btn-sm flex-fill" onclick="triggerPhoto('camera')">
                                        <i class="bi bi-camera-fill me-1"></i> Buka Kamera
                                    </button>
                                    <button type="button" class="btn btn-gallery-opt btn-sm flex-fill" onclick="triggerPhoto('file')">
                                        <i class="bi bi-images me-1"></i> Dari Galeri/File
                                    </button>
                                </div>
                                <input type="file" id="cameraInput" accept="image/*" capture="environment" class="d-none">
                                <input type="file" name="image" id="portfolioImage" class="d-none" accept="image/*">
                                <small class="text-muted d-block" id="imageHelp">Format: JPG, PNG, WEBP.</small>

                                <!-- Pratinjau & Kontrol Posisi Fokus Gambar -->
                                <div id="previewContainer" class="mt-3 p-2 bg-light rounded border d-none">
                                    <div class="preview-box overflow-hidden rounded mb-2">
                                        <img id="imagePreview" src="" alt="Pratinjau" class="w-100 preview-img">
                                    </div>
                                    <label class="form-label form-label-sm fw-semibold mb-1 text-muted">Posisi Fokus Gambar:</label>
                                    <div class="btn-group btn-group-sm w-100" role="group">
                                        <button type="button" class="btn btn-outline-secondary" onclick="setImagePosition('top')">Atas</button>
                                        <button type="button" class="btn btn-outline-secondary active" onclick="setImagePosition('center')">Tengah</button>
                                        <button type="button" class="btn btn-outline-secondary" onclick="setImagePosition('bottom')">Bawah</button>
                                    </div>
                                </div>
                            </div>

                            <!-- Editor Teks Berita (Bold, Miring, List, Heading) -->
                            <div class="mb-3">
                                <label class="form-label fw-semibold text-dark">Deskripsi Lengkap</label>
                                <div class="editor-toolbar d-flex flex-wrap gap-1 p-2">
                                    <button type="button" class="btn-tool" onclick="formatText('bold')" title="Tebal"><i class="bi bi-type-bold"></i></button>
                                    <button type="button" class="btn-tool" onclick="formatText('italic')" title="Miring"><i class="bi bi-type-italic"></i></button>
                                    <button type="button" class="btn-tool" onclick="formatText('underline')" title="Garis Bawah"><i class="bi bi-type-underline"></i></button>
                                    <button type="button" class="btn-tool" onclick="formatText('insertUnorderedList')" title="Bullet List"><i class="bi bi-list-ul"></i></button>
                                    <button type="button" class="btn-tool" onclick="formatText('insertOrderedList')" title="Numbered List"><i class="bi bi-list-ol"></i></button>
                                    <button type="button" class="btn-tool" onclick="formatHeading()" title="Heading"><i class="bi bi-type-h2"></i></button>
                                </div>
                                <div id="richEditor" class="form-control editor-content" contenteditable="true" placeholder="Tuliskan rincian pengerjaan proyek..."></div>
                                <textarea name="description" id="portfolioDesc" class="d-none"></textarea>
                            </div>

                            <div class="d-flex gap-2 pt-2">
                                <button type="submit" class="btn btn-emerald flex-grow-1">Simpan Data</button>
                                <button type="button" class="btn btn-light border" onclick="resetForm()">Batal / Reset</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- List Data Card -->
            <div class="col-12 col-xl-8 col-lg-7">
                <div class="card admin-card border-0 shadow-sm overflow-hidden">
                    <div class="card-header gradient-header-dark py-3">
                        <h5 class="card-title mb-0 fs-6 fw-bold text-white">Daftar Portofolio (Database JSON)</h5>
                    </div>
                    <div class="card-body p-0">
                        <?php if (empty($portfolios)): ?>
                            <div class="text-center p-4 text-muted">Belum ada portofolio. Silakan tambahkan melalui form.</div>
                        <?php else: ?>
                            <!-- Tampilan Desktop & Tablet: Tabel Bersih -->
                            <div class="table-responsive d-none d-md-block">
                                <table class="table table-hover align-middle mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th width="5%">#</th>
                                            <th width="15%">Foto</th>
                                            <th width="20%">Tanggal</th>
                                            <th width="25%">Judul</th>
                                            <th width="25%">Deskripsi</th>
                                            <th width="10%">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($portfolios as $index => $item): ?>
                                            <tr>
                                                <td><?= $index + 1 ?></td>
                                                <td>
                                                    <?php if (!empty($item['image'])): ?>
                                                        <img src="<?= base_url('uploads/portfolio/' . $item['image']) ?>" alt="thumb" class="rounded object-fit-cover shadow-xs" style="width: 60px; height: 45px; object-position: <?= esc($item['image_position'] ?? 'center') ?>;">
                                                    <?php else: ?>
                                                        <span class="badge bg-secondary">No Image</span>
                                                    <?php endif; ?>
                                                </td>
                                                <td><span class="date-pill"><?= esc($item['date'] ?? $item['created_at'] ?? '-') ?></span></td>
                                                <td><strong class="text-dark"><?= esc($item['title']) ?></strong></td>
                                                <td><small class="text-secondary"><?= strip_tags(substr($item['description'], 0, 60)) ?>...</small></td>
                                                <td>
                                                    <div class="d-flex gap-1">
                                                        <button class="btn btn-sm btn-outline-warning" onclick='editData(<?= json_encode($item) ?>)'><i class="bi bi-pencil-square"></i></button>
                                                        <form action="<?= base_url('admin/portfolio/delete/' . $item['id']) ?>" method="post" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                                            <?= csrf_field() ?>
                                                            <button type="submit" class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>

                            <!-- Tampilan Layar HP: Kartu Interaktif -->
                            <div class="d-md-none p-3 d-flex flex-column gap-3">
                                <?php foreach ($portfolios as $index => $item): ?>
                                    <div class="portfolio-card-mobile p-3 rounded-3">
                                        <div class="d-flex gap-3 align-items-center mb-2">
                                            <?php if (!empty($item['image'])): ?>
                                                <img src="<?= base_url('uploads/portfolio/' . $item['image']) ?>" alt="thumb" class="rounded-2 object-fit-cover shadow-xs" style="width: 70px; height: 70px; object-position: <?= esc($item['image_position'] ?? 'center') ?>;">
                                            <?php else: ?>
                                                <div class="rounded-2 bg-light text-muted d-flex align-items-center justify-content-center border" style="width: 70px; height: 70px;">
                                                    <i class="bi bi-image fs-4"></i>
                                                </div>
                                            <?php endif; ?>
                                            <div class="flex-grow-1 min-w-0">
                                                <span class="date-pill mb-1 d-inline-block"><?= esc($item['date'] ?? $item['created_at'] ?? '-') ?></span>
                                                <h6 class="fw-bold mb-1 text-truncate text-dark"><?= esc($item['title']) ?></h6>
                                                <small class="text-muted d-block text-truncate"><?= strip_tags($item['description']) ?></small>
                                            </div>
                                        </div>
                                        <div class="d-flex gap-2 pt-2 border-top">
                                            <button class="btn btn-sm btn-warning flex-fill" onclick='editData(<?= json_encode($item) ?>)'>
                                                <i class="bi bi-pencil-square me-1"></i> Edit
                                            </button>
                                            <form class="flex-fill" action="<?= base_url('admin/portfolio/delete/' . $item['id']) ?>" method="post" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                                <?= csrf_field() ?>
                                                <button type="submit" class="btn btn-sm btn-outline-danger w-100">
                                                    <i class="bi bi-trash me-1"></i> Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url('assets/js/admin.js') ?>"></script>
</body>
</html>