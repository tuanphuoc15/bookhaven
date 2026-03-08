<?php
session_start();
include "../includes/config.php";
$basePath = "../";
include "../includes/header.php";
?>

<div class="container mt-5">
<h2 class="mb-4">Gio hang cua ban</h2>

<?php if (empty($_SESSION['cart'])) { ?>
<div class="alert alert-info">Gio hang cua ban dang trong.</div>
<a href="../index.php" class="btn btn-secondary">Tiep tuc mua hang</a>
<?php } else { ?>
<div class="table-responsive">
<table class="table table-bordered align-middle">
<thead class="table-dark">
<tr>
<th>Hinh</th>
<th>Sach</th>
<th>Gia</th>
<th>So luong</th>
<th>Tong</th>
<th>Xoa</th>
</tr>
</thead>
<tbody>
<?php
$total = 0;
$bookStmt = mysqli_prepare($conn, "SELECT id, title, image, price FROM books WHERE id = ?");

foreach ($_SESSION['cart'] as $id => $qty) {
    $id = (int)$id;
    $qty = (int)$qty;
    if ($id <= 0 || $qty <= 0) {
        continue;
    }

    mysqli_stmt_bind_param($bookStmt, "i", $id);
    mysqli_stmt_execute($bookStmt);
    $result = mysqli_stmt_get_result($bookStmt);
    $row = mysqli_fetch_assoc($result);

    if (!$row) {
        continue;
    }

    $subtotal = (float)$row['price'] * $qty;
    $total += $subtotal;
?>
<tr>
<td width="120"><img src="../assets/images/books/<?php echo e($row['image']); ?>" width="80" alt="<?php echo e($row['title']); ?>"></td>
<td><?php echo e($row['title']); ?></td>
<td><?php echo number_format((float)$row['price']); ?> VND</td>
<td>
<a href="decrease.php?id=<?php echo (int)$id; ?>" class="btn btn-sm btn-secondary">-</a>
<?php echo $qty; ?>
<a href="increase.php?id=<?php echo (int)$id; ?>" class="btn btn-sm btn-secondary">+</a>
</td>
<td><?php echo number_format($subtotal); ?> VND</td>
<td><a href="remove_cart.php?id=<?php echo (int)$id; ?>" class="btn btn-danger btn-sm">Xoa</a></td>
</tr>
<?php } ?>
</tbody>
</table>
</div>

<h4 class="text-end text-danger">Tong tien: <?php echo number_format($total); ?> VND</h4>
<div class="mobile-actions mt-3">
<a href="../checkout.php" class="btn btn-success">Thanh toan</a>
<a href="../index.php" class="btn btn-secondary">Tiep tuc mua hang</a>
</div>
<?php } ?>
</div>

<?php include "../includes/footer.php"; ?>
