<?php
include "includes/config.php";
include "includes/header.php";

$limit = 8;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$page = $page > 0 ? $page : 1;
$start = ($page - 1) * $limit;

$search = isset($_GET['search']) ? trim($_GET['search']) : "";
$category = isset($_GET['category']) ? (int)$_GET['category'] : 0;

if ($search !== "") {
    $stmt = mysqli_prepare($conn, "SELECT * FROM books WHERE title LIKE ? LIMIT ? OFFSET ?");
    $keyword = "%" . $search . "%";
    mysqli_stmt_bind_param($stmt, "sii", $keyword, $limit, $start);

    $countStmt = mysqli_prepare($conn, "SELECT COUNT(*) AS total FROM books WHERE title LIKE ?");
    mysqli_stmt_bind_param($countStmt, "s", $keyword);
} elseif ($category > 0) {
    $stmt = mysqli_prepare($conn, "SELECT * FROM books WHERE category_id = ? LIMIT ? OFFSET ?");
    mysqli_stmt_bind_param($stmt, "iii", $category, $limit, $start);

    $countStmt = mysqli_prepare($conn, "SELECT COUNT(*) AS total FROM books WHERE category_id = ?");
    mysqli_stmt_bind_param($countStmt, "i", $category);
} else {
    $stmt = mysqli_prepare($conn, "SELECT * FROM books LIMIT ? OFFSET ?");
    mysqli_stmt_bind_param($stmt, "ii", $limit, $start);

    $countStmt = mysqli_prepare($conn, "SELECT COUNT(*) AS total FROM books");
}

mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

mysqli_stmt_execute($countStmt);
$countResult = mysqli_stmt_get_result($countStmt);
$totalBooks = (int) mysqli_fetch_assoc($countResult)['total'];
$totalPages = max(1, (int) ceil($totalBooks / $limit));
?>

<div class="container mt-3">
<div id="bannerSlider" class="carousel slide" data-bs-ride="carousel">
<div class="carousel-inner">
<div class="carousel-item active"><img src="assets/images/banner/banner1.jpg" class="d-block w-100 banner-img" alt="Banner 1"></div>
<div class="carousel-item"><img src="assets/images/banner/banner2.jpg" class="d-block w-100 banner-img" alt="Banner 2"></div>
<div class="carousel-item"><img src="assets/images/banner/banner3.jpg" class="d-block w-100 banner-img" alt="Banner 3"></div>
</div>
<button class="carousel-control-prev" type="button" data-bs-target="#bannerSlider" data-bs-slide="prev"><span class="carousel-control-prev-icon"></span></button>
<button class="carousel-control-next" type="button" data-bs-target="#bannerSlider" data-bs-slide="next"><span class="carousel-control-next-icon"></span></button>
</div>
</div>

<div class="hero-banner">
<div class="container text-center">
<h1>Kham pha the gioi tri thuc</h1>
<p>Hon 100+ cuon sach phat trien ban than va truyen cam hung</p>
<a href="shop.php" class="btn btn-warning btn-lg">Kham pha ngay</a>
</div>
</div>

<div class="container mt-4">
<h2 class="text-center mb-4">BookHaven Online Bookstore</h2>

<h3 class="text-center mt-5 mb-4">Sach ban chay</h3>
<div class="row">
<?php
$bestSellerResult = mysqli_query($conn, "SELECT * FROM books ORDER BY price DESC LIMIT 4");
while ($best = mysqli_fetch_assoc($bestSellerResult)) {
?>
<div class="col-md-3">
<div class="card shadow book-card position-relative">
<span class="badge bg-danger bestseller-badge">Best Seller</span>
<img src="assets/images/books/<?php echo e($best['image']); ?>" class="card-img-top" alt="<?php echo e($best['title']); ?>">
<div class="card-body">
<h6 class="card-title"><?php echo e($best['title']); ?></h6>
<p class="text-danger fw-bold"><?php echo number_format((float)$best['price']); ?> VND</p>
<a href="product-detail.php?id=<?php echo (int)$best['id']; ?>" class="btn btn-primary btn-sm">View</a>
<a href="cart/add_cart.php?id=<?php echo (int)$best['id']; ?>" class="btn btn-success btn-sm">Add to Cart</a>
</div>
</div>
</div>
<?php } ?>
</div>

<div class="mb-4 text-center">
<a href="index.php" class="btn btn-secondary">All</a>
<a href="index.php?category=1" class="btn btn-outline-dark">Phat trien ban than</a>
<a href="index.php?category=2" class="btn btn-outline-dark">Tam ly hoc</a>
<a href="index.php?category=3" class="btn btn-outline-dark">Truyen cam hung</a>
<a href="index.php?category=4" class="btn btn-outline-dark">Ky nang song</a>
<a href="index.php?category=5" class="btn btn-outline-dark">Kinh doanh</a>
<a href="index.php?category=6" class="btn btn-outline-dark">Triet ly</a>
</div>

<div class="row">
<?php while ($row = mysqli_fetch_assoc($result)) { ?>
<div class="col-md-3">
<div class="card shadow mb-4">
<img src="assets/images/books/<?php echo e($row['image']); ?>" class="card-img-top" style="height:250px; object-fit:cover;" alt="<?php echo e($row['title']); ?>">
<div class="card-body">
<h5 class="card-title"><?php echo e($row['title']); ?></h5>
<p>Author: <?php echo e($row['author']); ?></p>
<p class="text-danger fw-bold">Price: <?php echo number_format((float)$row['price']); ?> VND</p>
<a href="product-detail.php?id=<?php echo (int)$row['id']; ?>" class="btn btn-primary btn-sm">View</a>
<a href="cart/add_cart.php?id=<?php echo (int)$row['id']; ?>" onclick="showToast()" class="btn btn-success btn-sm">Add to Cart</a>
</div>
</div>
</div>
<?php } ?>
</div>

<nav>
<ul class="pagination justify-content-center">
<?php
$params = [];
if ($search !== "") {
    $params['search'] = $search;
}
if ($category > 0) {
    $params['category'] = $category;
}

for ($i = 1; $i <= $totalPages; $i++) {
    $params['page'] = $i;
    $url = 'index.php?' . http_build_query($params);
?>
<li class="page-item <?php echo $i === $page ? 'active' : ''; ?>">
<a class="page-link" href="<?php echo e($url); ?>"><?php echo $i; ?></a>
</li>
<?php } ?>
</ul>
</nav>
</div>

<div id="toast" style="position:fixed; bottom:20px; right:20px; background:#22c55e; color:white; padding:12px 20px; border-radius:6px; display:none; z-index:999;">
Da them vao gio hang
</div>

<?php include "includes/footer.php"; ?>
<script>
function showToast(){
const toast = document.getElementById("toast");
toast.style.display = "block";
setTimeout(()=>{ toast.style.display = "none"; },2000);
}
</script>
