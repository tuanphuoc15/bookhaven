<?php
include "includes/header.php";

$method = $_GET['method'] ?? 'cod';
$email = trim($_GET['email'] ?? '');
$phone = trim($_GET['phone'] ?? '');
$labels = [
    'cod' => 'COD',
    'vnpay' => 'VNPay',
    'momo' => 'MoMo',
    'bank_transfer' => 'Chuyen khoan ngan hang',
];
$methodLabel = $labels[$method] ?? 'COD';

$queryLink = 'my-orders.php';
if ($email !== '' && $phone !== '') {
    $queryLink .= '?email=' . urlencode($email) . '&phone=' . urlencode($phone);
}
?>

<div class="container text-center mt-5">
<h2 class="text-success">Đặt hàng thành công</h2>
<p>Cảm ơn bạn đã mua sách tại BookHaven.</p>
<p class="mb-4">Phương thức thanh toán: <strong><?php echo e($methodLabel); ?></strong></p>
<div class="d-flex justify-content-center gap-2">
<a href="<?php echo e($queryLink); ?>" class="btn btn-success">Xem đơn hang da mua</a>
<a href="index.php" class="btn btn-primary">Quay lại trang chủ</a>
</div>
</div>

<?php include "includes/footer.php"; ?>
