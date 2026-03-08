<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($basePath)) {
    $basePath = "";
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>BookHaven</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="<?php echo e($basePath); ?>assets/css/style.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
<div class="container">
<a class="navbar-brand fw-bold" href="<?php echo e($basePath); ?>index.php">BookHaven</a>
<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menu">
<span class="navbar-toggler-icon"></span>
</button>
<div class="collapse navbar-collapse" id="menu">
<ul class="navbar-nav ms-auto align-items-lg-center">
<li class="nav-item"><a class="nav-link" href="<?php echo e($basePath); ?>index.php">Trang chủ</a></li>
<li class="nav-item"><a class="nav-link" href="<?php echo e($basePath); ?>shop.php">Cửa hàng</a></li>
<li class="nav-item"><a class="nav-link" href="<?php echo e($basePath); ?>cart/cart.php">Giỏ hàng</a></li>
<li class="nav-item ms-lg-2"><a class="btn btn-light btn-sm" href="<?php echo e($basePath); ?>admin/login.php">Admin</a></li>
</ul>
</div>
</div>
</nav>
