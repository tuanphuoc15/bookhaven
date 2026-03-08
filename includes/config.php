<?php
$host = "localhost";
$user = "root";
$password = "";
$dbname = "bookhaven";

$conn = mysqli_connect($host, $user, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

mysqli_set_charset($conn, "utf8mb4");

if (!function_exists("e")) {
    function e($value)
    {
        return htmlspecialchars((string)$value, ENT_QUOTES, "UTF-8");
    }
}
?>
