<?php
session_start();
include "../includes/config.php";

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($id <= 0) {
    header("Location: ../index.php");
    exit();
}

$checkStmt = mysqli_prepare($conn, "SELECT id FROM books WHERE id = ?");
mysqli_stmt_bind_param($checkStmt, "i", $id);
mysqli_stmt_execute($checkStmt);
$exists = mysqli_stmt_get_result($checkStmt);

if (!mysqli_fetch_assoc($exists)) {
    header("Location: ../index.php");
    exit();
}

if (isset($_SESSION['cart'][$id])) {
    $_SESSION['cart'][$id]++;
} else {
    $_SESSION['cart'][$id] = 1;
}

header("Location: ../cart/cart.php");
exit();
?>
