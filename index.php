<?php
include "includes/config.php";
include "includes/header.php";

error_reporting(E_ALL);
ini_set('display_errors', 1);
?>

<div class="container mt-3">

<!-- BANNER SLIDER -->

<div id="bannerSlider" class="carousel slide" data-bs-ride="carousel">

<div class="carousel-inner">

<div class="carousel-item active">
<img src="assets/images/banner/banner1.jpg" class="d-block w-100 banner-img">
</div>

<div class="carousel-item">
<img src="assets/images/banner/banner2.jpg" class="d-block w-100 banner-img">
</div>

<div class="carousel-item">
<img src="assets/images/banner/banner3.jpg" class="d-block w-100 banner-img">
</div>

</div>

<button class="carousel-control-prev" type="button" data-bs-target="#bannerSlider" data-bs-slide="prev">
<span class="carousel-control-prev-icon"></span>
</button>

<button class="carousel-control-next" type="button" data-bs-target="#bannerSlider" data-bs-slide="next">
<span class="carousel-control-next-icon"></span>
</button>

</div>

</div>


<!-- HERO BANNER -->

<div class="hero-banner">

<div class="container text-center">

<h1>📚 Khám phá thế giới tri thức</h1>

<p>Hơn 100+ cuốn sách phát triển bản thân và truyền cảm hứng</p>

<a href="shop.php" class="btn btn-warning btn-lg">
Khám phá ngay
</a>

</div>

</div>


<div class="container mt-4">

<h2 class="text-center mb-4">
BookHaven Online Bookstore
</h2>


<!-- BEST SELLER -->

<h3 class="text-center mt-5 mb-4">
🔥 Sách bán chạy
</h3>

<div class="row">

<?php

$sql_best = "SELECT * FROM books ORDER BY price DESC LIMIT 4";

$result_best = mysqli_query($conn,$sql_best);

while($best = mysqli_fetch_assoc($result_best)){

?>

<div class="col-md-3">

<div class="card shadow book-card position-relative">

<span class="badge bg-danger bestseller-badge">
🔥 Best Seller
</span>

<img src="assets/images/books/<?php echo $best['image']; ?>" class="card-img-top">

<div class="card-body">

<h6 class="card-title">
<?php echo $best['title']; ?>
</h6>

<p class="text-danger fw-bold">
<?php echo number_format($best['price']); ?> VND
</p>

<a href="product-detail.php?id=<?php echo $best['id']; ?>" class="btn btn-primary btn-sm">
View
</a>

<a href="cart/add_cart.php?id=<?php echo $best['id']; ?>" class="btn btn-success btn-sm">
Add to Cart
</a>

</div>

</div>

</div>

<?php } ?>

</div>


<!-- CATEGORY -->

<div class="mb-4 text-center">

<a href="index.php" class="btn btn-secondary">All</a>

<a href="index.php?category=1" class="btn btn-outline-dark">Phát triển bản thân</a>

<a href="index.php?category=2" class="btn btn-outline-dark">Tâm lý học</a>

<a href="index.php?category=3" class="btn btn-outline-dark">Truyền cảm hứng</a>

<a href="index.php?category=4" class="btn btn-outline-dark">Kỹ năng sống</a>

<a href="index.php?category=5" class="btn btn-outline-dark">Kinh doanh</a>

<a href="index.php?category=6" class="btn btn-outline-dark">Triết lý</a>

</div>


<?php

$limit = 8;

$page = isset($_GET['page']) ? $_GET['page'] : 1;

$start = ($page - 1) * $limit;

if(isset($_GET['search'])){

$search = $_GET['search'];

$sql = "SELECT * FROM books
        WHERE title LIKE '%$search%'
        LIMIT $start,$limit";

}elseif(isset($_GET['category'])){

$category = $_GET['category'];

$sql = "SELECT * FROM books
        WHERE category_id = $category
        LIMIT $start,$limit";

}else{

$sql = "SELECT * FROM books
        LIMIT $start,$limit";

}

$result = mysqli_query($conn,$sql);

?>


<div class="row">

<?php while($row = mysqli_fetch_assoc($result)){ ?>

<div class="col-md-3">

<div class="card shadow mb-4">

<img src="assets/images/books/<?php echo $row['image']; ?>"
class="card-img-top"
style="height:250px; object-fit:cover;">

<div class="card-body">

<h5 class="card-title">
<?php echo $row['title']; ?>
</h5>

<p>
Author: <?php echo $row['author']; ?>
</p>

<p class="text-danger fw-bold">
Price: <?php echo number_format($row['price']); ?> VND
</p>

<a href="product-detail.php?id=<?php echo $row['id']; ?>"
class="btn btn-primary btn-sm">

View

</a>

<a href="cart/add_cart.php?id=<?php echo $row['id']; ?>"
onclick="showToast()"
class="btn btn-success btn-sm">

Add to Cart

</a>

</div>

</div>

</div>

<?php } ?>

</div>


<?php

$sql_total = "SELECT COUNT(*) as total FROM books";

$result_total = mysqli_query($conn,$sql_total);

$row_total = mysqli_fetch_assoc($result_total);

$total_books = $row_total['total'];

$total_pages = ceil($total_books / $limit);

?>


<nav>

<ul class="pagination justify-content-center">

<?php for($i=1;$i<=$total_pages;$i++){ ?>

<li class="page-item">

<a class="page-link"
href="index.php?page=<?php echo $i; ?>">

<?php echo $i; ?>

</a>

</li>

<?php } ?>

</ul>

</nav>

</div>


<!-- POPUP ADD TO CART -->

<div id="toast"
style="
position:fixed;
bottom:20px;
right:20px;
background:#22c55e;
color:white;
padding:12px 20px;
border-radius:6px;
display:none;
z-index:999;
">

Đã thêm vào giỏ hàng

</div>


<?php include "includes/footer.php"; ?>


<script>

function showToast(){

const toast = document.getElementById("toast");

toast.style.display = "block";

setTimeout(()=>{
toast.style.display = "none";
},2000);

}

</script>