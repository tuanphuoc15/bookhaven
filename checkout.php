<?php
session_start();
include "includes/config.php";
include "includes/header.php";

$isCartEmpty = empty($_SESSION['cart']);
$selectedMethod = $_POST['payment_method'] ?? 'cod';
?>

<div class="container mt-4">
<h2 class="text-center mb-4">Thanh toán</h2>

<?php if ($isCartEmpty) { ?>
<div class="alert alert-warning">Ban chua co san pham trong gio hang.</div>
<div class="text-center"><a href="index.php" class="btn btn-primary">Quay lại mua hàng</a></div>
<?php } else { ?>
<div class="row">
<div class="col-md-7 col-lg-6 offset-md-2 offset-lg-3">
<form action="process-order.php" method="POST" class="card shadow-sm p-3">
<div class="mb-3">
<label class="form-label">Họ tên</label>
<input type="text" name="name" class="form-control" maxlength="100" required>
</div>

<div class="mb-3">
<label class="form-label">Email</label>
<input type="email" name="email" class="form-control" maxlength="120" required>
</div>

<div class="mb-3">
<label class="form-label">Số điện thoại</label>
<input type="text" name="phone" class="form-control" maxlength="20" required>
</div>

<div class="mb-3">
<label class="form-label">Địa chỉ</label>
<textarea name="address" class="form-control" maxlength="255" required></textarea>
</div>

<div class="mb-3">
<label class="form-label">Phương thức thanh toán</label>
<select name="payment_method" class="form-select" required>
<option value="cod" <?php echo $selectedMethod === 'cod' ? 'selected' : ''; ?>>COD - Thanh toán khi nhan hang</option>
<option value="vnpay" <?php echo $selectedMethod === 'vnpay' ? 'selected' : ''; ?>>VNPay</option>
<option value="momo" <?php echo $selectedMethod === 'momo' ? 'selected' : ''; ?>>MoMo</option>
<option value="bank_transfer" <?php echo $selectedMethod === 'bank_transfer' ? 'selected' : ''; ?>>Chuyen khoan ngan hang</option>
</select>
</div>

<button type="submit" class="btn btn-success w-100">Đặt hàng</button>
</form>
</div>
</div>
<?php } ?>
</div>

<?php include "includes/footer.php"; ?>
