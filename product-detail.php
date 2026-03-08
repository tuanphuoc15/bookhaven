<?php
include "includes/config.php";
include "includes/header.php";

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
if ($id <= 0) {
    header("Location: index.php");
    exit();
}

$stmt = mysqli_prepare($conn, "SELECT * FROM books WHERE id = ?");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$book = mysqli_fetch_assoc($result);

if (!$book) {
    header("Location: index.php");
    exit();
}
?>

<div class="container mt-5">
<div class="row">
<div class="col-md-5">
<img src="assets/images/books/<?php echo e($book['image']); ?>" class="img-fluid rounded shadow" alt="<?php echo e($book['title']); ?>">
</div>

<div class="col-md-7">
<h2><?php echo e($book['title']); ?></h2>
<p class="text-muted">Tác giả: <?php echo e($book['author']); ?></p>
<h4 class="text-danger">Giá: <?php echo number_format((float)$book['price']); ?> VND</h4>
<hr>
<p><strong>Năm xuất bản:</strong> <?php echo e($book['publish_year']); ?></p>
<p><strong>Ngôn ngữ:</strong> <?php echo e($book['language']); ?></p>
<p><strong>Số trang:</strong> <?php echo e($book['pages']); ?></p>
<p><strong>Nhà xuất bản:</strong> <?php echo e($book['publisher']); ?></p>
<p class="mt-3"><?php echo nl2br(e($book['description'])); ?></p>

<a href="cart/add_cart.php?id=<?php echo (int)$book['id']; ?>" class="btn btn-success">Thêm vào giỏ</a>
<a href="index.php" class="btn btn-secondary">Quay lại</a>
</div>
</div>

<hr class="mt-5">
<h4>Sách liên quan</h4>
<div class="row">
<?php
$category = (int) $book['category_id'];
$relatedStmt = mysqli_prepare($conn, "SELECT * FROM books WHERE category_id = ? AND id != ? LIMIT 4");
mysqli_stmt_bind_param($relatedStmt, "ii", $category, $id);
mysqli_stmt_execute($relatedStmt);
$relatedResult = mysqli_stmt_get_result($relatedStmt);
while ($row = mysqli_fetch_assoc($relatedResult)) {
?>
<div class="col-md-3">
<div class="card shadow mt-3">
<img src="assets/images/books/<?php echo e($row['image']); ?>" class="card-img-top" style="height:220px; object-fit:cover;" alt="<?php echo e($row['title']); ?>">
<div class="card-body">
<h6><?php echo e($row['title']); ?></h6>
<p class="text-danger"><?php echo number_format((float)$row['price']); ?> VND</p>
<a href="product-detail.php?id=<?php echo (int)$row['id']; ?>" class="btn btn-primary btn-sm">Xem</a>
</div>
</div>
</div>
<?php } ?>
</div>

<hr class="mt-5">
<h4>Đánh giá sách</h4>
<form action="submit-review.php" method="POST">
<input type="hidden" name="book_id" value="<?php echo (int)$book['id']; ?>">

<div class="mb-3">
<label class="form-label">Tên</label>
<input type="text" name="name" class="form-control" maxlength="100" required>
</div>

<div class="mb-3">
<label class="form-label">Đánh giá</label>
<select name="rating" class="form-control">
<option value="5">5 sao</option>
<option value="4">4 sao</option>
<option value="3">3 sao</option>
<option value="2">2 sao</option>
<option value="1">1 sao</option>
</select>
</div>

<div class="mb-3">
<label class="form-label">Nhận xét</label>
<textarea name="comment" class="form-control" maxlength="1000"></textarea>
</div>

<button class="btn btn-success" type="submit">Gửi đánh giá</button>
</form>

<hr>
<h5>Nhận xét</h5>
<?php
$reviewStmt = mysqli_prepare($conn, "SELECT * FROM reviews WHERE book_id = ? ORDER BY id DESC");
mysqli_stmt_bind_param($reviewStmt, "i", $id);
mysqli_stmt_execute($reviewStmt);
$reviewResult = mysqli_stmt_get_result($reviewStmt);
while ($r = mysqli_fetch_assoc($reviewResult)) {
    $starCount = max(1, min(5, (int)$r['rating']));
    echo "<p><strong>" . e($r['name']) . "</strong> " . str_repeat("*", $starCount) . "<br>" . nl2br(e($r['comment'])) . "</p><hr>";
}
?>
</div>

<?php include "includes/footer.php"; ?>