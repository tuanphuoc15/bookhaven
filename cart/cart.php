<?php
session_start();
include "../includes/config.php";
include "../includes/header.php";
?>

<div class="container mt-5">

<h2 class="mb-4">🛒 Your Cart</h2>

<table class="table table-bordered">

<thead class="table-dark">
<tr>
<th>Image</th>
<th>Book</th>
<th>Price</th>
<th>Quantity</th>
<th>Total</th>
<th>Remove</th>
</tr>
</thead>

<tbody>

<?php

$total = 0;

if(isset($_SESSION['cart'])){

foreach($_SESSION['cart'] as $id => $qty){

$sql = "SELECT * FROM books WHERE id=$id";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($result);

$subtotal = $row['price'] * $qty;
$total += $subtotal;

?>

<tr>

<td width="120">
<img src="../assets/images/books/<?php echo $row['image']; ?>" width="80">
</td>

<td><?php echo $row['title']; ?></td>

<td><?php echo number_format($row['price']); ?> VND</td>

<td>

<a href="decrease.php?id=<?php echo $id; ?>" 
class="btn btn-sm btn-secondary">-</a>

<?php echo $qty; ?>

<a href="increase.php?id=<?php echo $id; ?>" 
class="btn btn-sm btn-secondary">+</a>

</td>

<td><?php echo number_format($subtotal); ?> VND</td>

</tr>
<td>

<a href="remove_cart.php?id=<?php echo $id; ?>"
class="btn btn-danger btn-sm">

Remove

</a>

</td>

<?php
}
}
?>

</tbody>

</table>

<h4 class="text-end text-danger">
Total: <?php echo number_format($total); ?> VND
</h4>
<a href="../checkout.php" class="btn btn-success">
Checkout
</a>

<a href="../index.php" class="btn btn-secondary">Continue Shopping</a>

</div>

<?php include "../includes/footer.php"; ?>