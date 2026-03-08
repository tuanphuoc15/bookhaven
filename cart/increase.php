<?php
session_start();

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($id <= 0) {
    header("Location: cart.php");
    exit();
}

if (isset($_SESSION['cart'][$id])) {
    $_SESSION['cart'][$id]++;
}

header("Location: cart.php");
exit();
?>
