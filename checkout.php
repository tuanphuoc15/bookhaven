<?php
session_start();
include "includes/config.php";
include "includes/header.php";

$isCartEmpty = empty($_SESSION['cart']);
?>

<div class="container mt-4">
<h2 class="text-center mb-4">Checkout</h2>

<?php if ($isCartEmpty) { ?>
<div class="alert alert-warning">Ban chua co san pham trong gio hang.</div>
<div class="text-center"><a href="index.php" class="btn btn-primary">Quay lai mua hang</a></div>
<?php } else { ?>
<div class="row">
<div class="col-md-6 offset-md-3">
<form action="process-order.php" method="POST">
<div class="mb-3">
<label class="form-label">Name</label>
<input type="text" name="name" class="form-control" maxlength="100" required>
</div>

<div class="mb-3">
<label class="form-label">Email</label>
<input type="email" name="email" class="form-control" maxlength="120" required>
</div>

<div class="mb-3">
<label class="form-label">Phone</label>
<input type="text" name="phone" class="form-control" maxlength="20" required>
</div>

<div class="mb-3">
<label class="form-label">Address</label>
<textarea name="address" class="form-control" maxlength="255" required></textarea>
</div>

<button type="submit" class="btn btn-success">Place Order</button>
</form>
</div>
</div>
<?php } ?>
</div>

<?php include "includes/footer.php"; ?>
