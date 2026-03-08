<?php
include __DIR__ . '/_bootstrap.php';

if (admin_is_logged_in()) {
    header('Location: index.php');
    exit();
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if ($username === ADMIN_USERNAME && $password === ADMIN_PASSWORD) {
        $_SESSION['admin_logged_in'] = true;
        header('Location: index.php');
        exit();
    }

    $error = 'Sai ten dang nhap hoac mat khau.';
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Admin Login - BookHaven</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-5">
<div class="row justify-content-center">
<div class="col-md-5">
<div class="card shadow-sm">
<div class="card-body p-4">
<h4 class="mb-3 text-center">Dang nhap Admin</h4>
<?php if ($error !== '') { ?>
<div class="alert alert-danger"><?php echo e($error); ?></div>
<?php } ?>
<form method="POST">
<div class="mb-3">
<label class="form-label">Ten dang nhap</label>
<input class="form-control" type="text" name="username" required>
</div>
<div class="mb-3">
<label class="form-label">Mat khau</label>
<input class="form-control" type="password" name="password" required>
</div>
<button class="btn btn-primary w-100" type="submit">Dang nhap</button>
</form>
<p class="text-muted small mt-3 mb-0">Mac dinh: admin / 123456</p>
</div>
</div>
</div>
</div>
</div>
</body>
</html>
