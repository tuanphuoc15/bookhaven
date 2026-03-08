<?php
include "includes/config.php";
include "includes/header.php";
?>

<div class="container mt-4">

<h2 class="text-center mb-4">All Books</h2>

<div class="row">

<?php

$sql = "SELECT * FROM books";
$result = mysqli_query($conn,$sql);

while($row = mysqli_fetch_assoc($result)){

?>

<div class="col-md-3">

<div class="card mb-4 shadow-sm">

<img src="assets/images/books/<?php echo $row['image']; ?>"
class="card-img-top"
style="height:250px; object-fit:cover;">

<div class="card-body">

<h5><?php echo $row['title']; ?></h5>

<p>Author: <?php echo $row['author']; ?></p>

<p class="text-danger fw-bold">
Price: <?php echo number_format($row['price']); ?> VND
</p>

<a href="product-detail.php?id=<?php echo $row['id']; ?>"
class="btn btn-primary btn-sm">
View
</a>

<a href="cart/add_cart.php?id=<?php echo $row['id']; ?>"
class="btn btn-success btn-sm">
Add to Cart
</a>

</div>
</div>
</div>

<?php } ?>

</div>
</div>

<?php include "includes/footer.php"; ?>