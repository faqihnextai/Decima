<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/x-icon" href="<?= base_url('assets/img/assets/logo.ico') ?>">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - Decima</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex align-items-center min-vh-100">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card shadow-sm border-0">
                    <div class="card-body p-4">
                        <h4 class="card-title text-center mb-4">Login Admin Decima</h4>
                        
                        <?php if (session()->getFlashdata('error')): ?>
                            <div class="alert alert-danger py-2"><?= session()->getFlashdata('error') ?></div>
                        <?php endif; ?>

                        <form action="<?= base_url('login/auth') ?>" method="post">
                            <div class="mb-3">
                                <label class="form-label">Username</label>
                                <input type="text" name="username" class="form-control" required autofocus>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Masuk</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>