<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="vi">

<head>

<meta charset="UTF-8">

<title>BookHaven</title>

<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- BOOTSTRAP -->

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- CSS -->

<link rel="stylesheet" href="assets/css/style.css">

<!-- FONT AWESOME -->

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

</head>

<body>

<!-- NAVBAR -->

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">

<div class="container">

<a class="navbar-brand fw-bold" href="index.php">
📚 BookHaven
</a>

<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menu">

<span class="navbar-toggler-icon"></span>

</button>

<div class="collapse navbar-collapse" id="menu">

<ul class="navbar-nav ms-auto">

<li class="nav-item">

<a class="nav-link" href="index.php">
Trang chủ
</a>

</li>

<li class="nav-item">

<a class="nav-link" href="shop.php">
Cửa hàng
</a>

</li>

<li class="nav-item">

<a class="nav-link" href="cart/cart.php">
🛒 Cart
</a>

</li>

</ul>

</div>

</div>

</nav>

<div class="container mt-4"></div>