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

$flashResult = mysqli_query($conn, "SELECT id, title, author, image, price FROM books ORDER BY RAND() LIMIT 4");
$categoriesForTabs = [
    1 => 'Phát triển bản thân',
    2 => 'Tâm lý học',
    5 => 'Kinh doanh',
    6 => 'Triết lý'
];
$tabData = [];
foreach ($categoriesForTabs as $catId => $catName) {
    $tabStmt = mysqli_prepare($conn, "SELECT id, title, author, image, price FROM books WHERE category_id = ? ORDER BY id DESC LIMIT 4");
    mysqli_stmt_bind_param($tabStmt, "i", $catId);
    mysqli_stmt_execute($tabStmt);
    $tabData[$catId] = mysqli_stmt_get_result($tabStmt);
}

$reviewsSql = "
  SELECT r.name, r.rating, r.comment, b.id AS book_id, b.title, b.image
  FROM reviews r
  JOIN books b ON b.id = r.book_id
  ORDER BY r.id DESC
  LIMIT 6
";
$featuredReviews = mysqli_query($conn, $reviewsSql);
$hasReviews = $featuredReviews && mysqli_num_rows($featuredReviews) > 0;

$dateColumn = null;
$dateCandidates = ['created_at', 'order_date', 'created_on', 'created'];
foreach ($dateCandidates as $candidate) {
    $colRs = mysqli_query($conn, "SHOW COLUMNS FROM orders LIKE '" . mysqli_real_escape_string($conn, $candidate) . "'");
    if ($colRs && mysqli_num_rows($colRs) > 0) {
        $dateColumn = $candidate;
        break;
    }
}

$rankTitle = 'Bảng xếp hạng bán chạy trong tuần';
$rankWhere = " WHERE (o.status IS NULL OR o.status != 'cancelled') ";
if ($dateColumn !== null) {
    $rankWhere .= " AND o.`$dateColumn` >= (NOW() - INTERVAL 7 DAY) ";
} else {
    $rankTitle = 'Bảng xếp hạng bán chạy';
}

$rankSql = "
  SELECT b.id, b.title, b.author, b.image, b.price, SUM(oi.quantity) AS sold_qty
  FROM order_items oi
  JOIN books b ON b.id = oi.book_id
  LEFT JOIN orders o ON o.id = oi.order_id
  $rankWhere
  GROUP BY b.id, b.title, b.author, b.image, b.price
  ORDER BY sold_qty DESC, b.id DESC
  LIMIT 10
";
$rankResult = mysqli_query($conn, $rankSql);
$hasRank = $rankResult && mysqli_num_rows($rankResult) > 0;
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

<div class="flash-sale reveal-on-scroll mb-5">
<div class="flash-sale-head">
<h3 class="mb-0"><i class="fa-solid fa-bolt"></i> Flash Sale Trong Ngày</h3>
<div id="flashTimer" class="flash-timer">00:00:00</div>
</div>
<div class="row g-3 mt-1">
<?php while ($flash = mysqli_fetch_assoc($flashResult)) {
    $discountPercent = rand(10, 35);
    $originPrice = (float)$flash['price'];
    $salePrice = $originPrice * (100 - $discountPercent) / 100;
?>
<div class="col-md-3">
<div class="card flash-card h-100">
<span class="flash-badge">-<?php echo $discountPercent; ?>%</span>
<img src="assets/images/books/<?php echo e($flash['image']); ?>" class="card-img-top" alt="<?php echo e($flash['title']); ?>">
<div class="card-body">
<h6 class="card-title"><?php echo e($flash['title']); ?></h6>
<p class="mb-1 text-muted"><?php echo e($flash['author']); ?></p>
<p class="mb-2"><span class="text-danger fw-bold"><?php echo number_format($salePrice); ?> VND</span> <small class="text-decoration-line-through text-muted"><?php echo number_format($originPrice); ?> VND</small></p>
<a href="product-detail.php?id=<?php echo (int)$flash['id']; ?>" class="btn btn-primary btn-sm">Mua ngay</a>
</div>
</div>
</div>
<?php } ?>
</div>
</div>

<h3 class="text-center mt-5 mb-4">Sách theo danh mục</h3>
<ul class="nav nav-pills justify-content-center mb-3 reveal-on-scroll" id="catTabs" role="tablist">
<?php $first = true; foreach ($categoriesForTabs as $catId => $catName) { ?>
<li class="nav-item" role="presentation">
<button class="nav-link <?php echo $first ? 'active' : ''; ?>" id="tab-<?php echo $catId; ?>" data-bs-toggle="pill" data-bs-target="#pane-<?php echo $catId; ?>" type="button" role="tab"><?php echo e($catName); ?></button>
</li>
<?php $first = false; } ?>
</ul>
<div class="tab-content reveal-on-scroll mb-5">
<?php $first = true; foreach ($categoriesForTabs as $catId => $catName) { ?>
<div class="tab-pane fade <?php echo $first ? 'show active' : ''; ?>" id="pane-<?php echo $catId; ?>" role="tabpanel">
<div class="row g-3">
<?php while ($rowCat = mysqli_fetch_assoc($tabData[$catId])) { ?>
<div class="col-md-3">
<div class="card h-100">
<img src="assets/images/books/<?php echo e($rowCat['image']); ?>" class="card-img-top" alt="<?php echo e($rowCat['title']); ?>">
<div class="card-body">
<h6 class="card-title"><?php echo e($rowCat['title']); ?></h6>
<p class="mb-2"><?php echo e($rowCat['author']); ?></p>
<p class="text-danger fw-bold"><?php echo number_format((float)$rowCat['price']); ?> VND</p>
<a href="product-detail.php?id=<?php echo (int)$rowCat['id']; ?>" class="btn btn-primary btn-sm">Xem chi tiết</a>
</div>
</div>
</div>
<?php } ?>
</div>
</div>
<?php $first = false; } ?>
</div>

<h3 class="text-center mt-4 mb-4">Sách bán chạy</h3>
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

<div class="weekly-rank reveal-on-scroll mt-5 mb-4">
<div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-3">
<h3 class="mb-0"><?php echo e($rankTitle); ?></h3>
<?php if ($dateColumn === null) { ?><span class="rank-note">Không có cột ngày đặt hàng, đang hiển thị theo tổng đơn.</span><?php } ?>
</div>
<?php if (!$hasRank) { ?>
<div class="alert alert-info mb-0">Chưa có dữ liệu đơn hàng để xếp hạng tuần này.</div>
<?php } else { ?>
<div class="table-responsive">
<table class="table rank-table mb-0">
<thead>
<tr>
<th>Hạng</th>
<th>Sách</th>
<th>Tác giả</th>
<th>Đã bán</th>
<th>Giá</th>
<th>Xem</th>
</tr>
</thead>
<tbody>
<?php $rankNo = 1; while ($rk = mysqli_fetch_assoc($rankResult)) { ?>
<tr>
<td><span class="rank-chip rank-<?php echo $rankNo <= 3 ? $rankNo : 4; ?>">#<?php echo $rankNo; ?></span></td>
<td class="rank-book">
<img src="assets/images/books/<?php echo e($rk['image']); ?>" alt="<?php echo e($rk['title']); ?>">
<span><?php echo e($rk['title']); ?></span>
</td>
<td><?php echo e($rk['author']); ?></td>
<td><strong><?php echo (int)$rk['sold_qty']; ?></strong></td>
<td><?php echo number_format((float)$rk['price']); ?> VND</td>
<td><a class="btn btn-primary btn-sm" href="product-detail.php?id=<?php echo (int)$rk['id']; ?>">Chi tiết</a></td>
</tr>
<?php $rankNo++; } ?>
</tbody>
</table>
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

<div class="featured-reviews reveal-on-scroll mt-5">
<h3 class="text-center mb-4">Đánh giá nổi bật</h3>
<?php if (!$hasReviews) { ?>
<div class="alert alert-info">Chưa có đánh giá nào. Hãy là người đầu tiên đánh giá sách!</div>
<?php } else { ?>
<div class="row g-3">
<?php while ($rv = mysqli_fetch_assoc($featuredReviews)) { ?>
<div class="col-md-4">
<div class="review-card h-100">
<div class="d-flex align-items-center gap-2 mb-2">
<img class="review-thumb" src="assets/images/books/<?php echo e($rv['image']); ?>" alt="<?php echo e($rv['title']); ?>">
<div>
<a href="product-detail.php?id=<?php echo (int)$rv['book_id']; ?>" class="review-book"><?php echo e($rv['title']); ?></a>
<div class="review-stars"><?php echo str_repeat('&#9733;', max(1, min(5, (int)$rv['rating']))); ?></div>
</div>
</div>
<p class="mb-1"><strong><?php echo e($rv['name']); ?></strong></p>
<p class="mb-0 review-comment"><?php echo e($rv['comment']); ?></p>
</div>
</div>
<?php } ?>
</div>
<?php } ?>
</div>

<div class="faq-home reveal-on-scroll mt-5">
<h3 class="text-center mb-4">FAQ và Chính sách</h3>
<div class="accordion" id="faqHome">
<div class="accordion-item">
<h2 class="accordion-header" id="faqOne">
<button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faqOneBody">Thời gian giao hàng bao lâu?</button>
</h2>
<div id="faqOneBody" class="accordion-collapse collapse show" data-bs-parent="#faqHome">
<div class="accordion-body">Khu vực nội thành từ 1-2 ngày, ngoại tỉnh từ 3-5 ngày làm việc.</div>
</div>
</div>
<div class="accordion-item">
<h2 class="accordion-header" id="faqTwo">
<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqTwoBody">Có được đổi trả không?</button>
</h2>
<div id="faqTwoBody" class="accordion-collapse collapse" data-bs-parent="#faqHome">
<div class="accordion-body">Được đổi trả trong 7 ngày nếu sách lỗi in ấn hoặc hư hại do vận chuyển.</div>
</div>
</div>
<div class="accordion-item">
<h2 class="accordion-header" id="faqThree">
<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqThreeBody">Thanh toán bằng cách nào?</button>
</h2>
<div id="faqThreeBody" class="accordion-collapse collapse" data-bs-parent="#faqHome">
<div class="accordion-body">Hỗ trợ COD, chuyển khoản ngân hàng, VNPay và MoMo.</div>
</div>
</div>
</div>
<div class="text-center mt-3">
<a class="btn btn-primary" href="policy.php">Xem đầy đủ chính sách</a>
</div>
</div>
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

(function(){
  const flashEnd = new Date();
  flashEnd.setHours(23,59,59,999);
  const timerEl = document.getElementById('flashTimer');
  if (!timerEl) return;

  function tick(){
    const now = new Date();
    let diff = Math.floor((flashEnd - now) / 1000);
    if (diff < 0) diff = 0;
    const h = String(Math.floor(diff / 3600)).padStart(2, '0');
    const m = String(Math.floor((diff % 3600) / 60)).padStart(2, '0');
    const s = String(diff % 60).padStart(2, '0');
    timerEl.textContent = `${h}:${m}:${s}`;
  }

  tick();
  setInterval(tick, 1000);
})();
</script>
