<?php
include __DIR__ . '/_bootstrap.php';
require_admin_login();

$categories = [
    1 => 'Phát triển bản thân',
    2 => 'Tâm lý học',
    3 => 'Truyền cảm hứng',
    4 => 'Kỹ năng sống',
    5 => 'Kinh doanh',
    6 => 'Triết lý',
];

function handle_image_upload($file)
{
    if (!isset($file) || !isset($file['error']) || $file['error'] === UPLOAD_ERR_NO_FILE) {
        return ['ok' => true, 'filename' => ''];
    }

    if ($file['error'] !== UPLOAD_ERR_OK) {
        return ['ok' => false, 'message' => 'Upload thất bại.'];
    }

    $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    $allowed = ['jpg', 'jpeg', 'png', 'webp'];
    if (!in_array($extension, $allowed, true)) {
        return ['ok' => false, 'message' => 'Chỉ chấp nhận file jpg, jpeg, png, webp.'];
    }

    $imageInfo = @getimagesize($file['tmp_name']);
    if ($imageInfo === false) {
        return ['ok' => false, 'message' => 'File upload không phải ảnh hợp lệ.'];
    }

    $targetDir = realpath(__DIR__ . '/../assets/images/books');
    if ($targetDir === false) {
        return ['ok' => false, 'message' => 'Thư mục lưu ảnh không tồn tại.'];
    }

    $newName = 'book_' . date('Ymd_His') . '_' . bin2hex(random_bytes(4)) . '.' . $extension;
    $targetPath = $targetDir . DIRECTORY_SEPARATOR . $newName;

    if (!move_uploaded_file($file['tmp_name'], $targetPath)) {
        return ['ok' => false, 'message' => 'Không thể lưu ảnh upload.'];
    }

    return ['ok' => true, 'filename' => $newName];
}

$action = $_GET['action'] ?? 'list';
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $postAction = $_POST['form_action'] ?? '';

    if ($postAction === 'delete') {
        $deleteId = (int)($_POST['id'] ?? 0);
        if ($deleteId > 0) {
            $stmt = mysqli_prepare($conn, 'DELETE FROM books WHERE id = ?');
            mysqli_stmt_bind_param($stmt, 'i', $deleteId);
            mysqli_stmt_execute($stmt);
        }
        header('Location: books.php');
        exit();
    }

    if ($postAction === 'save') {
        $bookId = (int)($_POST['id'] ?? 0);
        $title = trim($_POST['title'] ?? '');
        $author = trim($_POST['author'] ?? '');
        $price = (float)($_POST['price'] ?? 0);
        $description = trim($_POST['description'] ?? '');
        $image = trim($_POST['image'] ?? '');
        $currentImage = trim($_POST['current_image'] ?? '');
        $categoryId = (int)($_POST['category_id'] ?? 0);
        $publishYear = (int)($_POST['publish_year'] ?? 0);
        $language = trim($_POST['language'] ?? '');
        $pages = (int)($_POST['pages'] ?? 0);
        $publisher = trim($_POST['publisher'] ?? '');

        if ($title === '' || $author === '' || $price <= 0) {
            $error = 'Vui lòng nhập đầy đủ Tiêu đề, Tác giả và Giá hợp lệ.';
            $action = $bookId > 0 ? 'edit' : 'create';
            $id = $bookId;
        } else {
            $uploadResult = handle_image_upload($_FILES['image_file'] ?? null);
            if (!$uploadResult['ok']) {
                $error = $uploadResult['message'];
                $action = $bookId > 0 ? 'edit' : 'create';
                $id = $bookId;
            } else {
                if ($uploadResult['filename'] !== '') {
                    $image = $uploadResult['filename'];
                } elseif ($image === '' && $currentImage !== '') {
                    $image = $currentImage;
                }

                if ($bookId > 0) {
                    $stmt = mysqli_prepare($conn, 'UPDATE books SET title=?, author=?, price=?, description=?, image=?, category_id=?, publish_year=?, language=?, pages=?, publisher=? WHERE id=?');
                    mysqli_stmt_bind_param($stmt, 'ssdssiisisi', $title, $author, $price, $description, $image, $categoryId, $publishYear, $language, $pages, $publisher, $bookId);
                    mysqli_stmt_execute($stmt);
                } else {
                    $stmt = mysqli_prepare($conn, 'INSERT INTO books(title, author, price, description, image, category_id, publish_year, language, pages, publisher) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
                    mysqli_stmt_bind_param($stmt, 'ssdssiisis', $title, $author, $price, $description, $image, $categoryId, $publishYear, $language, $pages, $publisher);
                    mysqli_stmt_execute($stmt);
                }
                header('Location: books.php');
                exit();
            }
        }
    }
}

$book = [
    'id' => 0,
    'title' => '',
    'author' => '',
    'price' => '',
    'description' => '',
    'image' => '',
    'category_id' => 1,
    'publish_year' => '',
    'language' => '',
    'pages' => '',
    'publisher' => '',
];

if (($action === 'edit' || $action === 'create') && $id > 0 && $_SERVER['REQUEST_METHOD'] !== 'POST') {
    $stmt = mysqli_prepare($conn, 'SELECT * FROM books WHERE id = ?');
    mysqli_stmt_bind_param($stmt, 'i', $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $found = mysqli_fetch_assoc($result);
    if ($found) {
        $book = $found;
    } else {
        $action = 'list';
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST' && ($action === 'create' || $action === 'edit')) {
    $book = [
        'id' => (int)($_POST['id'] ?? 0),
        'title' => trim($_POST['title'] ?? ''),
        'author' => trim($_POST['author'] ?? ''),
        'price' => trim($_POST['price'] ?? ''),
        'description' => trim($_POST['description'] ?? ''),
        'image' => trim($_POST['image'] ?? ''),
        'category_id' => (int)($_POST['category_id'] ?? 1),
        'publish_year' => trim($_POST['publish_year'] ?? ''),
        'language' => trim($_POST['language'] ?? ''),
        'pages' => trim($_POST['pages'] ?? ''),
        'publisher' => trim($_POST['publisher'] ?? ''),
    ];
}

$books = mysqli_query($conn, 'SELECT id, title, author, price, category_id, image FROM books ORDER BY id DESC');
?>
<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Quản lý sách - Admin</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<nav class="navbar navbar-dark bg-dark">
<div class="container-fluid px-4">
<a class="navbar-brand" href="index.php">BookHaven Admin</a>
<div>
<a class="btn btn-outline-light btn-sm me-2" href="index.php">Dashboard</a>
<a class="btn btn-outline-light btn-sm me-2" href="orders.php">Đơn hàng</a>
<a class="btn btn-outline-warning btn-sm" href="logout.php">Đăng xuất</a>
</div>
</div>
</nav>

<div class="container py-4">
<div class="d-flex justify-content-between align-items-center mb-3">
<h3 class="mb-0">Quản lý sách</h3>
<a class="btn btn-primary" href="books.php?action=create">+ Thêm sách</a>
</div>

<?php if ($error !== '') { ?>
<div class="alert alert-danger"><?php echo e($error); ?></div>
<?php } ?>

<?php if ($action === 'create' || $action === 'edit') { ?>
<div class="card shadow-sm mb-4">
<div class="card-body">
<h5 class="mb-3"><?php echo $action === 'edit' ? 'Sửa sách' : 'Thêm sách mới'; ?></h5>
<form method="POST" class="row g-3" enctype="multipart/form-data">
<input type="hidden" name="form_action" value="save">
<input type="hidden" name="id" value="<?php echo (int)$book['id']; ?>">
<input type="hidden" name="current_image" value="<?php echo e($book['image']); ?>">

<div class="col-md-6">
<label class="form-label">Tiêu đề</label>
<input type="text" name="title" class="form-control" value="<?php echo e($book['title']); ?>" required>
</div>
<div class="col-md-6">
<label class="form-label">Tác giả</label>
<input type="text" name="author" class="form-control" value="<?php echo e($book['author']); ?>" required>
</div>
<div class="col-md-3">
<label class="form-label">Giá (VND)</label>
<input type="number" min="1" step="1000" name="price" class="form-control" value="<?php echo e((string)$book['price']); ?>" required>
</div>
<div class="col-md-3">
<label class="form-label">Danh mục</label>
<select name="category_id" class="form-select">
<?php foreach ($categories as $catId => $catName) { ?>
<option value="<?php echo $catId; ?>" <?php echo (int)$book['category_id'] === $catId ? 'selected' : ''; ?>><?php echo e($catName); ?></option>
<?php } ?>
</select>
</div>
<div class="col-md-3">
<label class="form-label">Năm xuất bản</label>
<input type="number" min="1900" max="2100" name="publish_year" class="form-control" value="<?php echo e((string)$book['publish_year']); ?>">
</div>
<div class="col-md-3">
<label class="form-label">Số trang</label>
<input type="number" min="1" name="pages" class="form-control" value="<?php echo e((string)$book['pages']); ?>">
</div>
<div class="col-md-6">
<label class="form-label">Nhà xuất bản</label>
<input type="text" name="publisher" class="form-control" value="<?php echo e($book['publisher']); ?>">
</div>
<div class="col-md-6">
<label class="form-label">Ngôn ngữ</label>
<input type="text" name="language" class="form-control" value="<?php echo e($book['language']); ?>">
</div>
<div class="col-md-6">
<label class="form-label">Upload ảnh sách (jpg, jpeg, png, webp)</label>
<input type="file" name="image_file" class="form-control" accept=".jpg,.jpeg,.png,.webp,image/*">
<?php if (!empty($book['image'])) { ?>
<small class="text-muted">Ảnh hiện tại: <?php echo e($book['image']); ?></small>
<?php } ?>
</div>
<div class="col-md-6">
<label class="form-label">Hoặc nhập tên file ảnh có sẵn</label>
<input type="text" name="image" class="form-control" value="<?php echo e($book['image']); ?>" placeholder="ví dụ: book1.jpg">
</div>
<div class="col-12">
<label class="form-label">Mô tả</label>
<textarea name="description" rows="4" class="form-control"><?php echo e($book['description']); ?></textarea>
</div>
<div class="col-12 d-flex gap-2">
<button class="btn btn-success" type="submit">Lưu</button>
<a class="btn btn-secondary" href="books.php">Hủy</a>
</div>
</form>
</div>
</div>
<?php } ?>

<div class="card shadow-sm">
<div class="card-body">
<div class="table-responsive">
<table class="table table-bordered align-middle mb-0">
<thead class="table-dark">
<tr>
<th>ID</th>
<th>Ảnh</th>
<th>Tiêu đề</th>
<th>Tác giả</th>
<th>Giá</th>
<th>Danh mục</th>
<th>Thao tác</th>
</tr>
</thead>
<tbody>
<?php while ($row = mysqli_fetch_assoc($books)) { ?>
<tr>
<td>#<?php echo (int)$row['id']; ?></td>
<td style="width:90px;"><?php if (!empty($row['image'])) { ?><img src="../assets/images/books/<?php echo e($row['image']); ?>" style="width:60px;height:80px;object-fit:cover;" alt="book"><?php } ?></td>
<td><?php echo e($row['title']); ?></td>
<td><?php echo e($row['author']); ?></td>
<td><?php echo number_format((float)$row['price']); ?> VND</td>
<td><?php echo e($categories[(int)$row['category_id']] ?? 'Khác'); ?></td>
<td>
<a class="btn btn-sm btn-primary" href="books.php?action=edit&id=<?php echo (int)$row['id']; ?>">Sửa</a>
<form method="POST" class="d-inline" onsubmit="return confirm('Xóa sách này?');">
<input type="hidden" name="form_action" value="delete">
<input type="hidden" name="id" value="<?php echo (int)$row['id']; ?>">
<button class="btn btn-sm btn-danger" type="submit">Xóa</button>
</form>
</td>
</tr>
<?php } ?>
</tbody>
</table>
</div>
</div>
</div>
</div>
</body>
</html>