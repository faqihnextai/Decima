<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="<?= base_url('assets/img/assets/logo.ico') ?>">
    <title>Kelola Berita Portofolio - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4 bg-light">
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="fw-bold mb-0">Kelola Berita & Portofolio</h3>
                <small class="text-muted">Penyimpanan murni berbasis File JSON</small>
            </div>
            <div>
                <a href="<?= base_url('/') ?>" target="_blank" class="btn btn-outline-secondary me-2">Lihat Landing Page</a>
                <a href="<?= base_url('logout') ?>" class="btn btn-outline-danger">Logout</a>
            </div>
        </div>

        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?= session()->getFlashdata('success') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <div class="row">
            <!-- Form Input / Edit -->
            <div class="col-lg-4 col-md-5">
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-header bg-primary text-white py-3">
                        <h5 class="card-title mb-0" id="formTitle">Tambah Berita / Proyek</h5>
                    </div>
                    <div class="card-body p-4">
                        <form action="<?= base_url('admin/portfolio/save') ?>" method="post" enctype="multipart/form-data">
                            <?= csrf_field() ?>
                            <input type="hidden" name="id" id="portfolioId">
                            <input type="hidden" name="existing_image" id="portfolioExistingImage">

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Judul Berita / Proyek</label>
                                <input type="text" name="title" id="portfolioTitle" class="form-control" placeholder="Contoh: Instalasi Steel Door Gedung A" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Tanggal Berita / Proyek</label>
                                <input type="date" name="date" id="portfolioDate" class="form-control" value="<?= date('Y-m-d') ?>" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Foto Dokumentasi</label>
                                <input type="file" name="image" id="portfolioImage" class="form-control" accept="image/*">
                                <small class="text-muted" id="imageHelp">Format: JPG, PNG, WEBP.</small>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Deskripsi Lengkap</label>
                                <textarea name="description" id="portfolioDesc" rows="5" class="form-control" placeholder="Tuliskan rincian pengerjaan proyek..." required></textarea>
                            </div>

                            <div class="d-flex gap-2 pt-2">
                                <button type="submit" class="btn btn-success flex-grow-1">Simpan</button>
                                <button type="button" class="btn btn-secondary" onclick="resetForm()">Batal / Reset</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Tabel Daftar Data -->
            <div class="col-lg-8 col-md-7">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-dark text-white py-3">
                        <h5 class="card-title mb-0">Daftar Portofolio (Database JSON)</h5>
                    </div>
                    <div class="card-body p-0 table-responsive">
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
                                <?php if (empty($portfolios)): ?>
                                    <tr><td colspan="6" class="text-center p-4 text-muted">Belum ada portofolio. Silakan tambahkan melalui form di samping.</td></tr>
                                <?php else: ?>
                                    <?php foreach ($portfolios as $index => $item): ?>
                                        <tr>
                                            <td><?= $index + 1 ?></td>
                                            <td>
                                                <?php if (!empty($item['image'])): ?>
                                                    <img src="<?= base_url('uploads/portfolio/' . $item['image']) ?>" alt="thumbnail" class="rounded" style="width: 60px; height: 45px; object-fit: cover;">
                                                <?php else: ?>
                                                    <span class="badge bg-secondary">No Image</span>
                                                <?php endif; ?>
                                            </td>
                                            <td><small class="text-muted"><?= esc($item['date'] ?? $item['created_at'] ?? '-') ?></small></td>
                                            <td><strong><?= esc($item['title']) ?></strong></td>
                                            <td><small class="text-secondary"><?= esc(substr($item['description'], 0, 70)) ?>...</small></td>
                                            <td>
                                                <div class="d-flex gap-1">
                                                    <button class="btn btn-sm btn-warning" onclick='editData(<?= json_encode($item) ?>)'>Edit</button>
                                                    <form action="<?= base_url('admin/portfolio/delete/' . $item['id']) ?>" method="post" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                                        <?= csrf_field() ?>
                                                        <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function editData(data) {
            document.getElementById('formTitle').innerText = 'Edit Berita / Proyek';
            document.getElementById('portfolioId').value = data.id;
            document.getElementById('portfolioTitle').value = data.title;
            document.getElementById('portfolioDate').value = data.date || data.created_at || '';
            document.getElementById('portfolioDesc').value = data.description;
            document.getElementById('portfolioExistingImage').value = data.image || '';
            document.getElementById('imageHelp').innerText = data.image ? 'Gambar saat ini: ' + data.image + ' (Biarkan kosong jika tidak ingin ganti)' : 'Format: JPG, PNG, WEBP.';
        }

        function resetForm() {
            document.getElementById('formTitle').innerText = 'Tambah Berita / Proyek';
            document.getElementById('portfolioId').value = '';
            document.getElementById('portfolioTitle').value = '';
            document.getElementById('portfolioDate').value = '<?= date('Y-m-d') ?>';
            document.getElementById('portfolioDesc').value = '';
            document.getElementById('portfolioExistingImage').value = '';
            document.getElementById('portfolioImage').value = '';
            document.getElementById('imageHelp').innerText = 'Format: JPG, PNG, WEBP.';
        }
    </script>
</body>
</html>