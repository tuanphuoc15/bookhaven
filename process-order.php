<?php
session_start();
include "includes/config.php";

$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$address = $_POST['address'];

$sql = "INSERT INTO orders(name,email,phone,address)
VALUES('$name','$email','$phone','$address')";

mysqli_query($conn,$sql);

$order_id = mysqli_insert_id($conn);

foreach($_SESSION['cart'] as $book_id => $qty){

$insert = "INSERT INTO order_items(order_id,book_id,quantity)
VALUES('$order_id','$book_id','$qty')";

mysqli_query($conn,$insert);

}

unset($_SESSION['cart']);

header("Location: order-success.php");
?>