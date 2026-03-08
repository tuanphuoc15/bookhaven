<?php
include __DIR__ . '/_bootstrap.php';
require_admin_login();

$totalBooks = (int) mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM books"))['total'];
$totalOrders = (int) mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM orders"))['total'];
$totalReviews = (int) mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM reviews"))['total'];

$revenueQuery = "
    SELECT COALESCE(SUM(oi.quantity * b.price), 0) AS revenue
    FROM order_items oi
    JOIN books b ON b.id = oi.book_id
";
$totalRevenue = (float) mysqli_fetch_assoc(mysqli_query($conn, $revenueQuery))['revenue'];
?>
<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Bảng điều khiển Admin - BookHaven</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<nav class="navbar navbar-dark bg-dark">
<div class="container-fluid px-4">
<span class="navbar-brand mb-0 h1">BookHaven Admin</span>
<div>
<a class="btn btn-outline-light btn-sm me-2" href="orders.php">Quản lý đơn hàng</a>
<a class="btn btn-outline-light btn-sm me-2" href="books.php">Quản lý sách</a>
<a class="btn btn-outline-warning btn-sm" href="logout.php">Đăng xuất</a>
</div>
</div>
</nav>

<div class="container py-4">
<h3 class="mb-4">Tổng quan hệ thống</h3>
<div class="row g-3">
<div class="col-md-3">
<div class="card shadow-sm"><div class="card-body"><p class="text-muted mb-1">Số sách</p><h4><?php echo $totalBooks; ?></h4></div></div>
</div>
<div class="col-md-3">
<div class="card shadow-sm"><div class="card-body"><p class="text-muted mb-1">Số đơn hàng</p><h4><?php echo $totalOrders; ?></h4></div></div>
</div>
<div class="col-md-3">
<div class="card shadow-sm"><div class="card-body"><p class="text-muted mb-1">Số đánh giá</p><h4><?php echo $totalReviews; ?></h4></div></div>
</div>
<div class="col-md-3">
<div class="card shadow-sm"><div class="card-body"><p class="text-muted mb-1">Doanh thu tạm tính</p><h4><?php echo number_format($totalRevenue); ?> VND</h4></div></div>
</div>
</div>

<div class="card mt-4 shadow-sm">
<div class="card-body">
<h5 class="card-title">Đi nhanh khi demo</h5>
<ul class="mb-0">
<li>Vào <strong>Quản lý đơn hàng</strong> để xem danh sách đơn.</li>
<li>Mở chi tiết đơn để xem sản phẩm và tổng tiền.</li>
</ul>
</div>
</div>
</div>
</body>
</html>