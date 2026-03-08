<?php
include "includes/config.php";
include "includes/header.php";

function bind_dynamic_params($stmt, $types, $params)
{
    if ($types === "") {
        return;
    }

    $bindValues = [$types];
    foreach ($params as $key => $value) {
        $bindValues[] = &$params[$key];
    }

    call_user_func_array('mysqli_stmt_bind_param', array_merge([$stmt], $bindValues));
}

$limit = 8;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$page = $page > 0 ? $page : 1;
$start = ($page - 1) * $limit;

$search = isset($_GET['search']) ? trim($_GET['search']) : "";
$category = isset($_GET['category']) ? (int)$_GET['category'] : 0;
$minPrice = isset($_GET['min_price']) ? (int)$_GET['min_price'] : 0;
$maxPrice = isset($_GET['max_price']) ? (int)$_GET['max_price'] : 0;
$sort = isset($_GET['sort']) ? trim($_GET['sort']) : "newest";

$allowedSorts = [
    'newest' => 'id DESC',
    'price_asc' => 'price ASC',
    'price_desc' => 'price DESC',
    'title_asc' => 'title ASC',
    'title_desc' => 'title DESC',
];

if (!isset($allowedSorts[$sort])) {
    $sort = 'newest';
}

$whereSql = " WHERE 1=1";
$whereTypes = "";
$whereParams = [];

if ($search !== "") {
    $whereSql .= " AND title LIKE ?";
    $whereTypes .= "s";
    $whereParams[] = "%" . $search . "%";
}

if ($category > 0) {
    $whereSql .= " AND category_id = ?";
    $whereTypes .= "i";
    $whereParams[] = $category;
}

if ($minPrice > 0) {
    $whereSql .= " AND price >= ?";
    $whereTypes .= "i";
    $whereParams[] = $minPrice;
}

if ($maxPrice > 0 && $maxPrice >= $minPrice) {
    $whereSql .= " AND price <= ?";
    $whereTypes .= "i";
    $whereParams[] = $maxPrice;
}

$countSql = "SELECT COUNT(*) AS total FROM books" . $whereSql;
$countStmt = mysqli_prepare($conn, $countSql);
bind_dynamic_params($countStmt, $whereTypes, $whereParams);
mysqli_stmt_execute($countStmt);
$countResult = mysqli_stmt_get_result($countStmt);
$totalBooks = (int) mysqli_fetch_assoc($countResult)['total'];
$totalPages = max(1, (int) ceil($totalBooks / $limit));

if ($page > $totalPages) {
    $page = $totalPages;
    $start = ($page - 1) * $limit;
}

$listSql = "SELECT * FROM books" . $whereSql . " ORDER BY " . $allowedSorts[$sort] . " LIMIT ? OFFSET ?";
$listStmt = mysqli_prepare($conn, $listSql);
$listTypes = $whereTypes . "ii";
$listParams = $whereParams;
$listParams[] = $limit;
$listParams[] = $start;
bind_dynamic_params($listStmt, $listTypes, $listParams);
mysqli_stmt_execute($listStmt);
$result = mysqli_stmt_get_result($listStmt);
?>

<div class="container mt-3 reveal-on-scroll">
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

<div class="hero-banner reveal-on-scroll">
<div class="container text-center">
<h1>Khám phá thế giới tri thức</h1>
<p>Hơn 100+ cuốn sách phát triển bản thân và truyền cảm hứng</p>
<a href="shop.php" class="btn btn-warning btn-lg">Khám phá ngay</a>
</div>
</div>

<div class="container mt-4">
<h2 class="text-center mb-4">BookHaven Online Bookstore</h2>

<h3 class="text-center mt-5 mb-4">Sách bán chạy</h3>
<div class="row">
<?php
$bestSellerResult = mysqli_query($conn, "SELECT * FROM books ORDER BY price DESC LIMIT 4");
while ($best = mysqli_fetch_assoc($bestSellerResult)) {
?>
<div class="col-md-3 reveal-on-scroll">
<div class="card shadow book-card position-relative">
<span class="badge bg-danger bestseller-badge">Bán chạy</span>
<img src="assets/images/books/<?php echo e($best['image']); ?>" class="card-img-top" alt="<?php echo e($best['title']); ?>">
<div class="card-body">
<h6 class="card-title"><?php echo e($best['title']); ?></h6>
<p class="text-danger fw-bold"><?php echo number_format((float)$best['price']); ?> VND</p>
<a href="product-detail.php?id=<?php echo (int)$best['id']; ?>" class="btn btn-primary btn-sm">Xem</a>
<a href="cart/add_cart.php?id=<?php echo (int)$best['id']; ?>" class="btn btn-success btn-sm">Thêm vào giỏ</a>
</div>
</div>
</div>
<?php } ?>
</div>

<div class="card shadow-sm mt-4 mb-4 reveal-on-scroll">
<div class="card-body">
<form method="GET" class="row g-2 align-items-end">
<div class="col-md-3 reveal-on-scroll">
<label class="form-label mb-1">Từ khóa</label>
<input type="text" name="search" class="form-control" value="<?php echo e($search); ?>" placeholder="Nhập tên sách...">
</div>
<div class="col-md-2">
<label class="form-label mb-1">Danh mục</label>
<select name="category" class="form-select">
<option value="0">Tất cả</option>
<option value="1" <?php echo $category === 1 ? 'selected' : ''; ?>>Phát triển bản thân</option>
<option value="2" <?php echo $category === 2 ? 'selected' : ''; ?>>Tâm lý học</option>
<option value="3" <?php echo $category === 3 ? 'selected' : ''; ?>>Truyền cảm hứng</option>
<option value="4" <?php echo $category === 4 ? 'selected' : ''; ?>>Kỹ năng sống</option>
<option value="5" <?php echo $category === 5 ? 'selected' : ''; ?>>Kinh doanh</option>
<option value="6" <?php echo $category === 6 ? 'selected' : ''; ?>>Triết lý</option>
</select>
</div>
<div class="col-md-2">
<label class="form-label mb-1">Giá từ</label>
<input type="number" min="0" name="min_price" class="form-control" value="<?php echo $minPrice > 0 ? (int)$minPrice : ''; ?>">
</div>
<div class="col-md-2">
<label class="form-label mb-1">Giá đến</label>
<input type="number" min="0" name="max_price" class="form-control" value="<?php echo $maxPrice > 0 ? (int)$maxPrice : ''; ?>">
</div>
<div class="col-md-2">
<label class="form-label mb-1">Sắp xếp</label>
<select name="sort" class="form-select">
<option value="newest" <?php echo $sort === 'newest' ? 'selected' : ''; ?>>Mới nhất</option>
<option value="price_asc" <?php echo $sort === 'price_asc' ? 'selected' : ''; ?>>Giá tăng dần</option>
<option value="price_desc" <?php echo $sort === 'price_desc' ? 'selected' : ''; ?>>Giá giảm dần</option>
<option value="title_asc" <?php echo $sort === 'title_asc' ? 'selected' : ''; ?>>Tên A-Z</option>
<option value="title_desc" <?php echo $sort === 'title_desc' ? 'selected' : ''; ?>>Tên Z-A</option>
</select>
</div>
<div class="col-md-1 d-grid gap-2">
<button type="submit" class="btn btn-primary">Lọc</button>
<a href="index.php" class="btn btn-outline-secondary">Reset</a>
</div>
</form>
</div>
</div>

<div class="row">
<?php while ($row = mysqli_fetch_assoc($result)) { ?>
<div class="col-md-3 reveal-on-scroll">
<div class="card shadow mb-4">
<img src="assets/images/books/<?php echo e($row['image']); ?>" class="card-img-top" style="height:250px; object-fit:cover;" alt="<?php echo e($row['title']); ?>">
<div class="card-body">
<h5 class="card-title"><?php echo e($row['title']); ?></h5>
<p>Tác giả: <?php echo e($row['author']); ?></p>
<p class="text-danger fw-bold">Giá: <?php echo number_format((float)$row['price']); ?> VND</p>
<a href="product-detail.php?id=<?php echo (int)$row['id']; ?>" class="btn btn-primary btn-sm">Xem</a>
<a href="cart/add_cart.php?id=<?php echo (int)$row['id']; ?>" onclick="showToast()" class="btn btn-success btn-sm">Thêm vào giỏ</a>
</div>
</div>
</div>
<?php } ?>
</div>

<?php if ($totalBooks === 0) { ?>
<div class="alert alert-warning">Không tìm thấy sách phù hợp bộ lọc.</div>
<?php } ?>

<nav class="reveal-on-scroll">
<ul class="pagination justify-content-center">
<?php
$params = [];
if ($search !== "") {
    $params['search'] = $search;
}
if ($category > 0) {
    $params['category'] = $category;
}
if ($minPrice > 0) {
    $params['min_price'] = $minPrice;
}
if ($maxPrice > 0) {
    $params['max_price'] = $maxPrice;
}
if ($sort !== 'newest') {
    $params['sort'] = $sort;
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
Đã thêm vào giỏ hàng
</div>

<?php include "includes/footer.php"; ?>
<script>
function showToast(){
const toast = document.getElementById("toast");
toast.style.display = "block";
setTimeout(()=>{ toast.style.display = "none"; },2000);
}
</script>
