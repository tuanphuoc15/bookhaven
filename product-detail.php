<?php
include "includes/config.php";
include "includes/header.php";

$id = $_GET['id'];

$sql = "SELECT * FROM books WHERE id = $id";
$result = mysqli_query($conn,$sql);
$book = mysqli_fetch_assoc($result);
?>

<div class="container mt-5">

<div class="row">

<div class="col-md-5">
<img src="assets/images/books/<?php echo $book['image']; ?>"
class="img-fluid rounded shadow">

</div>


<div class="col-md-7">

<h2><?php echo $book['title']; ?></h2>

<p class="text-muted">
Author: <?php echo $book['author']; ?>
</p>

<h4 class="text-danger">
Price: <?php echo number_format($book['price']); ?> VND
</h4>

<hr>

<p><strong>Năm xuất bản:</strong> <?php echo $book['publish_year']; ?></p>
<p><strong>Ngôn ngữ:</strong> <?php echo $book['language']; ?></p>
<p><strong>Số trang:</strong> <?php echo $book['pages']; ?></p>
<p><strong>Nhà xuất bản:</strong> <?php echo $book['publisher']; ?></p>

<p class="mt-3">
<?php echo $book['description']; ?>
</p>

<a href="cart/add_cart.php?id=<?php echo $book['id']; ?>" 
class="btn btn-success">
Add to Cart
</a>

<a href="index.php" 
class="btn btn-secondary">
Back
</a>

</div>

</div>


<!-- SÁCH LIÊN QUAN -->

<hr class="mt-5">

<h4>Sách liên quan</h4>

<div class="row">

<?php

$category = $book['category_id'];

$sql_related = "SELECT * FROM books 
                WHERE category_id = $category 
                AND id != $id
                LIMIT 4";

$result_related = mysqli_query($conn,$sql_related);

while($row = mysqli_fetch_assoc($result_related)){
?>

<div class="col-md-3">

<div class="card shadow mt-3">

<img src="assets/images/books/<?php echo $row['image']; ?>" 
class="card-img-top"
style="height:220px; object-fit:cover;">

<div class="card-body">

<h6><?php echo $row['title']; ?></h6>

<p class="text-danger">

<?php echo number_format($row['price']); ?> VND

</p>

<a href="product-detail.php?id=<?php echo $row['id']; ?>" 
class="btn btn-primary btn-sm">

View

</a>

</div>

</div>

</div>

<?php } ?>

</div>


<!-- ĐÁNH GIÁ -->

<hr class="mt-5">

<h4>Đánh giá sách</h4>

<form action="submit-review.php" method="POST">

<input type="hidden" name="book_id" value="<?php echo $book['id']; ?>">

<div class="mb-3">

<label>Tên</label>

<input type="text" name="name" class="form-control" required>

</div>

<div class="mb-3">

<label>Đánh giá</label>

<select name="rating" class="form-control">

<option value="5">⭐⭐⭐⭐⭐</option>
<option value="4">⭐⭐⭐⭐</option>
<option value="3">⭐⭐⭐</option>
<option value="2">⭐⭐</option>
<option value="1">⭐</option>

</select>

</div>

<div class="mb-3">

<label>Nhận xét</label>

<textarea name="comment" class="form-control"></textarea>

</div>

<button class="btn btn-success">

Gửi đánh giá

</button>

</form>


<!-- HIỂN THỊ REVIEW -->

<hr>

<h5>Nhận xét</h5>

<?php

$sql_review = "SELECT * FROM reviews WHERE book_id = $id ORDER BY id DESC";

$result_review = mysqli_query($conn,$sql_review);

while($r = mysqli_fetch_assoc($result_review)){

echo "<p><strong>".$r['name']."</strong> ";

for($i=1;$i<=$r['rating'];$i++){

echo "⭐";

}

echo "<br>".$r['comment']."</p><hr>";

}

?>

</div>

<?php include "includes/footer.php"; ?>