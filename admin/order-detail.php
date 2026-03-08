<?php
include __DIR__ . '/_bootstrap.php';
require_admin_login();

$orderId = isset($_GET['id']) ? (int) $_GET['id'] : 0;
if ($orderId <= 0) {
    header('Location: orders.php');
    exit();
}

$orderStmt = mysqli_prepare($conn, "SELECT * FROM orders WHERE id = ?");
mysqli_stmt_bind_param($orderStmt, "i", $orderId);
mysqli_stmt_execute($orderStmt);
$orderResult = mysqli_stmt_get_result($orderStmt);
$order = mysqli_fetch_assoc($orderResult);

if (!$order) {
    header('Location: orders.php');
    exit();
}

$itemsStmt = mysqli_prepare($conn, "
    SELECT oi.quantity, b.title, b.price
    FROM order_items oi
    JOIN books b ON b.id = oi.book_id
    WHERE oi.order_id = ?
");
mysqli_stmt_bind_param($itemsStmt, "i", $orderId);
mysqli_stmt_execute($itemsStmt);
$items = mysqli_stmt_get_result($itemsStmt);

$total = 0;
?>
<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Chi tiet don hang #<?php echo (int)$orderId; ?></title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-4">
<a href="orders.php" class="btn btn-secondary btn-sm mb-3">&larr; Quay lai danh sach don</a>
<div class="card shadow-sm mb-3">
<div class="card-body">
<h4 class="mb-3">Don hang #<?php echo (int)$order['id']; ?></h4>
<p class="mb-1"><strong>Khach hang:</strong> <?php echo e($order['name']); ?></p>
<p class="mb-1"><strong>Email:</strong> <?php echo e($order['email']); ?></p>
<p class="mb-1"><strong>Dien thoai:</strong> <?php echo e($order['phone']); ?></p>
<p class="mb-0"><strong>Dia chi:</strong> <?php echo e($order['address']); ?></p>
</div>
</div>

<div class="card shadow-sm">
<div class="card-body">
<h5 class="mb-3">San pham trong don</h5>
<table class="table table-bordered">
<thead class="table-light">
<tr><th>Sach</th><th>Gia</th><th>So luong</th><th>Thanh tien</th></tr>
</thead>
<tbody>
<?php while ($item = mysqli_fetch_assoc($items)) {
    $line = (float)$item['price'] * (int)$item['quantity'];
    $total += $line;
?>
<tr>
<td><?php echo e($item['title']); ?></td>
<td><?php echo number_format((float)$item['price']); ?> VND</td>
<td><?php echo (int)$item['quantity']; ?></td>
<td><?php echo number_format($line); ?> VND</td>
</tr>
<?php } ?>
</tbody>
</table>
<h5 class="text-end text-danger mb-0">Tong tien: <?php echo number_format($total); ?> VND</h5>
</div>
</div>
</div>
</body>
</html>
