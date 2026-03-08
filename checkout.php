<?php
session_start();
include "includes/config.php";
include "includes/header.php";
?>

<div class="container mt-4">

<h2 class="text-center mb-4">Checkout</h2>

<div class="row">

<div class="col-md-6 offset-md-3">

<form action="process-order.php" method="POST">

<div class="mb-3">
<label>Name</label>
<input type="text" name="name" class="form-control" required>
</div>

<div class="mb-3">
<label>Email</label>
<input type="email" name="email" class="form-control" required>
</div>

<div class="mb-3">
<label>Phone</label>
<input type="text" name="phone" class="form-control" required>
</div>

<div class="mb-3">
<label>Address</label>
<textarea name="address" class="form-control" required></textarea>
</div>

<button type="submit" class="btn btn-success">
Place Order
</button>

</form>

</div>

</div>

</div>

<?php include "includes/footer.php"; ?>