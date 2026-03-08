<?php
include __DIR__ . '/_bootstrap.php';
require_admin_login();

$hasStatus = admin_has_order_status_column($conn);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $hasStatus) {
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
?>
<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Quan ly don hang - Admin</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<nav class="navbar navbar-dark bg-dark">
<div class="container-fluid px-4">
<a class="navbar-brand" href="index.php">BookHaven Admin</a>
<div>
<a class="btn btn-outline-light btn-sm me-2" href="index.php">Dashboard</a>
<a class="btn btn-outline-warning btn-sm" href="logout.php">Dang xuat</a>
</div>
</div>
</nav>

<div class="container py-4">
<h3 class="mb-3">Danh sach don hang</h3>
<?php if (!$hasStatus) { ?>
<div class="alert alert-info">Bang <code>orders</code> chua co cot <code>status</code>, hien tai chi xem danh sach don hang.</div>
<?php } ?>
<div class="table-responsive">
<table class="table table-bordered bg-white">
<thead class="table-dark">
<tr>
<th>ID</th>
<th>Khach hang</th>
<th>Email</th>
<th>Dien thoai</th>
<th>Tong tien</th>
<th>Chi tiet</th>
<?php if ($hasStatus) { ?><th>Trang thai</th><?php } ?>
</tr>
</thead>
<tbody>
<?php while ($order = mysqli_fetch_assoc($orders)) { ?>
<tr>
<td>#<?php echo (int)$order['id']; ?></td>
<td><?php echo e($order['name']); ?></td>
<td><?php echo e($order['email']); ?></td>
<td><?php echo e($order['phone']); ?></td>
<td><?php echo number_format((float)$order['total_amount']); ?> VND</td>
<td><a class="btn btn-sm btn-primary" href="order-detail.php?id=<?php echo (int)$order['id']; ?>">Xem</a></td>
<?php if ($hasStatus) { ?>
<td>
<form method="POST" class="d-flex gap-2">
<input type="hidden" name="order_id" value="<?php echo (int)$order['id']; ?>">
<select class="form-select form-select-sm" name="status">
<?php
$current = $order['status'] ?? 'pending';
$statuses = ['pending' => 'Pending', 'processing' => 'Processing', 'completed' => 'Completed', 'cancelled' => 'Cancelled'];
foreach ($statuses as $value => $label) {
    $selected = $current === $value ? 'selected' : '';
    echo "<option value=\"" . e($value) . "\" $selected>" . e($label) . "</option>";
}
?>
</select>
<button class="btn btn-sm btn-success" type="submit">Luu</button>
</form>
</td>
<?php } ?>
</tr>
<?php } ?>
</tbody>
</table>
</div>
</div>
</body>
</html>
