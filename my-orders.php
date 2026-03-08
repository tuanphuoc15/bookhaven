<?php
include "includes/config.php";

$email = trim($_GET['email'] ?? '');
$phone = trim($_GET['phone'] ?? '');
$alertMessage = '';
$alertType = 'info';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['action'] ?? '') === 'cancel_order') {
    $orderId = (int)($_POST['order_id'] ?? 0);
    $email = trim($_POST['email'] ?? '');
    $phone = trim($_POST['phone'] ?? '');

    if ($orderId > 0 && $email !== '' && $phone !== '' && filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $cancelStmt = mysqli_prepare(
            $conn,
            "UPDATE orders SET status = 'cancelled' WHERE id = ? AND email = ? AND phone = ? AND status = 'pending'"
        );
        mysqli_stmt_bind_param($cancelStmt, 'iss', $orderId, $email, $phone);
        mysqli_stmt_execute($cancelStmt);

        if (mysqli_stmt_affected_rows($cancelStmt) > 0) {
            $alertMessage = 'Huy don thanh cong.';
            $alertType = 'success';
        } else {
            $alertMessage = 'Khong the huy don (don da xu ly hoac thong tin khong khop).';
            $alertType = 'warning';
        }
    } else {
        $alertMessage = 'Thong tin huy don khong hop le.';
        $alertType = 'danger';
    }
}

include "includes/header.php";

$searched = isset($_GET['email']) || isset($_GET['phone']) || ($_SERVER['REQUEST_METHOD'] === 'POST' && $email !== '' && $phone !== '');
$orders = [];
$methodLabels = [
    'cod' => 'COD',
    'vnpay' => 'VNPay',
    'momo' => 'MoMo',
    'bank_transfer' => 'Chuyen khoan',
];

if ($searched && $email !== '' && $phone !== '' && filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $query = "
        SELECT o.*, COALESCE(SUM(oi.quantity * b.price), 0) AS total_amount
        FROM orders o
        LEFT JOIN order_items oi ON oi.order_id = o.id
        LEFT JOIN books b ON b.id = oi.book_id
        WHERE o.email = ? AND o.phone = ?
        GROUP BY o.id
        ORDER BY o.id DESC
    ";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 'ss', $email, $phone);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    while ($row = mysqli_fetch_assoc($result)) {
        $orders[] = $row;
    }
}
?>

<div class="container mt-4">
<h2 class="text-center mb-4">Tra cuu don hang</h2>

<div class="card shadow-sm mb-4">
<div class="card-body">
<form method="GET" class="row g-3 align-items-end">
<div class="col-md-5">
<label class="form-label">Email dat hang</label>
<input type="email" name="email" class="form-control" value="<?php echo e($email); ?>" required>
</div>
<div class="col-md-5">
<label class="form-label">So dien thoai</label>
<input type="text" name="phone" class="form-control" value="<?php echo e($phone); ?>" required>
</div>
<div class="col-md-2 d-grid">
<button class="btn btn-primary" type="submit">Xem don</button>
</div>
</form>
</div>
</div>

<?php if ($alertMessage !== '') { ?>
<div class="alert alert-<?php echo e($alertType); ?>"><?php echo e($alertMessage); ?></div>
<?php } ?>

<?php if ($searched && ($email === '' || $phone === '' || !filter_var($email, FILTER_VALIDATE_EMAIL))) { ?>
<div class="alert alert-warning">Vui long nhap dung email va so dien thoai.</div>
<?php } ?>

<?php if ($searched && $email !== '' && $phone !== '' && filter_var($email, FILTER_VALIDATE_EMAIL)) { ?>
<?php if (count($orders) === 0) { ?>
<div class="alert alert-info">Khong tim thay don hang phu hop.</div>
<?php } else { ?>
<?php foreach ($orders as $order) { ?>
<div class="card shadow-sm mb-3">
<div class="card-body">
<div class="d-flex justify-content-between flex-wrap gap-2 mb-2">
<h5 class="mb-0">Don #<?php echo (int)$order['id']; ?></h5>
<span class="badge text-bg-secondary"><?php echo e($order['status'] ?? 'pending'); ?></span>
</div>
<p class="mb-1"><strong>Thanh toan:</strong> <?php echo e($methodLabels[$order['payment_method'] ?? 'cod'] ?? strtoupper((string)($order['payment_method'] ?? 'cod'))); ?></p>
<p class="mb-1"><strong>Dia chi:</strong> <?php echo e($order['address']); ?></p>
<p class="mb-2"><strong>Tong tien:</strong> <?php echo number_format((float)$order['total_amount']); ?> VND</p>

<?php if (($order['status'] ?? 'pending') === 'pending') { ?>
<form method="POST" class="mb-3" onsubmit="return confirm('Ban chac chan muon huy don nay?');">
<input type="hidden" name="action" value="cancel_order">
<input type="hidden" name="order_id" value="<?php echo (int)$order['id']; ?>">
<input type="hidden" name="email" value="<?php echo e($email); ?>">
<input type="hidden" name="phone" value="<?php echo e($phone); ?>">
<button type="submit" class="btn btn-outline-danger btn-sm">Huy don</button>
</form>
<?php } ?>

<div class="table-responsive">
<table class="table table-sm table-bordered mb-0">
<thead class="table-light">
<tr>
<th>Sach</th>
<th>Gia</th>
<th>So luong</th>
<th>Thanh tien</th>
</tr>
</thead>
<tbody>
<?php
$itemStmt = mysqli_prepare($conn, "
    SELECT b.title, b.price, oi.quantity
    FROM order_items oi
    JOIN books b ON b.id = oi.book_id
    WHERE oi.order_id = ?
");
$orderId = (int)$order['id'];
mysqli_stmt_bind_param($itemStmt, 'i', $orderId);
mysqli_stmt_execute($itemStmt);
$itemResult = mysqli_stmt_get_result($itemStmt);
while ($item = mysqli_fetch_assoc($itemResult)) {
    $line = (float)$item['price'] * (int)$item['quantity'];
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
</div>
</div>
</div>
<?php } ?>
<?php } ?>
<?php } ?>
</div>

<?php include "includes/footer.php"; ?>
