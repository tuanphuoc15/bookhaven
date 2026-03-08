<?php
session_start();
include "includes/config.php";

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: checkout.php");
    exit();
}

if (empty($_SESSION['cart'])) {
    header("Location: cart/cart.php");
    exit();
}

$name = trim($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');
$phone = trim($_POST['phone'] ?? '');
$address = trim($_POST['address'] ?? '');
$paymentMethod = trim($_POST['payment_method'] ?? 'cod');

$allowedMethods = ['cod', 'vnpay', 'momo', 'bank_transfer'];
if (!in_array($paymentMethod, $allowedMethods, true)) {
    $paymentMethod = 'cod';
}

if ($name === '' || $email === '' || $phone === '' || $address === '') {
    header("Location: checkout.php");
    exit();
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header("Location: checkout.php");
    exit();
}

if (!preg_match('/^[0-9+\-\s]{8,20}$/', $phone)) {
    header("Location: checkout.php");
    exit();
}

mysqli_begin_transaction($conn);

try {
    $status = 'pending';
    $orderStmt = mysqli_prepare($conn, "INSERT INTO orders(name, email, phone, address, status, payment_method) VALUES (?, ?, ?, ?, ?, ?)");
    mysqli_stmt_bind_param($orderStmt, "ssssss", $name, $email, $phone, $address, $status, $paymentMethod);
    mysqli_stmt_execute($orderStmt);

    $orderId = mysqli_insert_id($conn);
    $itemStmt = mysqli_prepare($conn, "INSERT INTO order_items(order_id, book_id, quantity) VALUES (?, ?, ?)");

    foreach ($_SESSION['cart'] as $bookId => $qty) {
        $bookId = (int)$bookId;
        $qty = (int)$qty;

        if ($bookId <= 0 || $qty <= 0) {
            continue;
        }

        mysqli_stmt_bind_param($itemStmt, "iii", $orderId, $bookId, $qty);
        mysqli_stmt_execute($itemStmt);
    }

    mysqli_commit($conn);
    unset($_SESSION['cart']);

    header("Location: order-success.php?method=" . urlencode($paymentMethod));
    exit();
} catch (Throwable $e) {
    mysqli_rollback($conn);
    header("Location: checkout.php");
    exit();
}
?>
