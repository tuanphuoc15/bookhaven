<?php

include "includes/config.php";

$book_id = $_POST['book_id'];
$name = $_POST['name'];
$rating = $_POST['rating'];
$comment = $_POST['comment'];

$sql = "INSERT INTO reviews(book_id,name,rating,comment)
        VALUES('$book_id','$name','$rating','$comment')";

mysqli_query($conn,$sql);

header("Location: product-detail.php?id=".$book_id);

?>