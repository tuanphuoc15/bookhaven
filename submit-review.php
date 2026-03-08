<?php
include "includes/config.php";

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: index.php");
    exit();
}

$bookId = isset($_POST['book_id']) ? (int)$_POST['book_id'] : 0;
$name = trim($_POST['name'] ?? '');
$rating = isset($_POST['rating']) ? (int)$_POST['rating'] : 0;
$comment = trim($_POST['comment'] ?? '');

if ($bookId <= 0 || $name === '' || $rating < 1 || $rating > 5) {
    header("Location: index.php");
    exit();
}

if (mb_strlen($name) > 100) {
    $name = mb_substr($name, 0, 100);
}
if (mb_strlen($comment) > 1000) {
    $comment = mb_substr($comment, 0, 1000);
}

$stmt = mysqli_prepare($conn, "INSERT INTO reviews(book_id, name, rating, comment) VALUES (?, ?, ?, ?)");
mysqli_stmt_bind_param($stmt, "isis", $bookId, $name, $rating, $comment);
mysqli_stmt_execute($stmt);

header("Location: product-detail.php?id=" . $bookId);
exit();
?>
