<?php
include "includes/config.php";
include "includes/header.php";
?>

<div class="container mt-4">
<h2 class="text-center mb-4">All Books</h2>
<div class="row">
<?php
$result = mysqli_query($conn, "SELECT * FROM books");
while ($row = mysqli_fetch_assoc($result)) {
?>
<div class="col-md-3">
<div class="card mb-4 shadow-sm">
<img src="assets/images/books/<?php echo e($row['image']); ?>" class="card-img-top" style="height:250px; object-fit:cover;" alt="<?php echo e($row['title']); ?>">
<div class="card-body">
<h5><?php echo e($row['title']); ?></h5>
<p>Author: <?php echo e($row['author']); ?></p>
<p class="text-danger fw-bold">Price: <?php echo number_format((float)$row['price']); ?> VND</p>
<a href="product-detail.php?id=<?php echo (int)$row['id']; ?>" class="btn btn-primary btn-sm">View</a>
<a href="cart/add_cart.php?id=<?php echo (int)$row['id']; ?>" class="btn btn-success btn-sm">Add to Cart</a>
</div>
</div>
</div>
<?php } ?>
</div>
</div>

<?php include "includes/footer.php"; ?>
