<?php
include "includes/header.php";

$method = $_GET['method'] ?? 'cod';
$labels = [
    'cod' => 'COD',
    'vnpay' => 'VNPay',
    'momo' => 'MoMo',
    'bank_transfer' => 'Chuyen khoan ngan hang',
];
$methodLabel = $labels[$method] ?? 'COD';
?>

<div class="container text-center mt-5">
<h2 class="text-success">Dat hang thanh cong</h2>
<p>Cam on ban da mua sach tai BookHaven.</p>
<p class="mb-4">Phuong thuc thanh toan: <strong><?php echo e($methodLabel); ?></strong></p>
<a href="index.php" class="btn btn-primary">Quay lai trang chu</a>
</div>

<?php include "includes/footer.php"; ?>
