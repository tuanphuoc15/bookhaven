<?php
$host = "sql312.infinityfree.com";
$user = "if0_41336257";
$password = "Tp157505";
$dbname = "if0_41336257_bookhaven";

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
