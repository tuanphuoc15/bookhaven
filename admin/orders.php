<?php
include __DIR__ . '/_bootstrap.php';
require_admin_login();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $orderId = (int) ($_POST['order_id'] ?? 0);
    $status = trim($_POST['status'] ?? '');
    $allowed = ['pending', 'processing', 'completed', 'cancelled'];

    if ($orderId > 0 && in_array($status, $allowed, true)) {
        $update = mysqli_prepare($conn, "UPDATE orders SET status = ? WHERE id = ?");
        mysqli_stmt_bind_param($update, "si", $status, $orderId);
        mysqli_stmt_execute($update);
    }

    header('Location: orders.php');
    exit();
}

$query = "
    SELECT o.*, COALESCE(SUM(oi.quantity * b.price), 0) AS total_amount
    FROM orders o
    LEFT JOIN order_items oi ON oi.order_id = o.id
    LEFT JOIN books b ON b.id = oi.book_id
    GROUP BY o.id
    ORDER BY o.id DESC
";
$orders = mysqli_query($conn, $query);

$methodLabels = [
    'cod' => 'COD',
    'vnpay' => 'VNPay',
    'momo' => 'MoMo',
    'bank_transfer' => 'Chuyển khoản',
];

$statusLabels = [
    'pending' => 'Chờ xử lý',
    'processing' => 'Đang xử lý',
    'completed' => 'Hoàn thành',
    'cancelled' => 'Đã hủy',
];
?>
<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Quản lý đơn hàng - Admin</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<nav class="navbar navbar-dark bg-dark">
<div class="container-fluid px-4">
<a class="navbar-brand" href="index.php">BookHaven Admin</a>
<div>
<a class="btn btn-outline-light btn-sm me-2" href="index.php">Dashboard</a>
<a class="btn btn-outline-light btn-sm me-2" href="books.php">Sách</a>
<a class="btn btn-outline-warning btn-sm" href="logout.php">Đăng xuất</a>
</div>
</div>
</nav>

<div class="container py-4">
<h3 class="mb-3">Danh sách đơn hàng</h3>
<div class="table-responsive">
<table class="table table-bordered bg-white align-middle">
<thead class="table-dark">
<tr>
<th>ID</th>
<th>Khách hàng</th>
<th>Email</th>
<th>Điện thoại</th>
<th>Thanh toán</th>
<th>Tổng tiền</th>
<th>Chi tiết</th>
<th>Trạng thái</th>
</tr>
</thead>
<tbody>
<?php while ($order = mysqli_fetch_assoc($orders)) { ?>
<tr>
<td>#<?php echo (int)$order['id']; ?></td>
<td><?php echo e($order['name']); ?></td>
<td><?php echo e($order['email']); ?></td>
<td><?php echo e($order['phone']); ?></td>
<td><?php echo e($methodLabels[$order['payment_method'] ?? 'cod'] ?? strtoupper((string)($order['payment_method'] ?? 'cod'))); ?></td>
<td><?php echo number_format((float)$order['total_amount']); ?> VND</td>
<td><a class="btn btn-sm btn-primary" href="order-detail.php?id=<?php echo (int)$order['id']; ?>">Xem</a></td>
<td>
<form method="POST" class="d-flex gap-2">
<input type="hidden" name="order_id" value="<?php echo (int)$order['id']; ?>">
<select class="form-select form-select-sm" name="status">
<?php
$current = $order['status'] ?? 'pending';
foreach ($statusLabels as $value => $label) {
    $selected = $current === $value ? 'selected' : '';
    echo "<option value=\"" . e($value) . "\" $selected>" . e($label) . "</option>";
}
?>
</select>
<button class="btn btn-sm btn-success" type="submit">Lưu</button>
</form>
</td>
</tr>
<?php } ?>
</tbody>
</table>
</div>
</div>
</body>
</html>