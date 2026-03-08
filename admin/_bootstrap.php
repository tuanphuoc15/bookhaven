<?php
session_start();
include __DIR__ . "/../includes/config.php";

const ADMIN_USERNAME = "admin";
const ADMIN_PASSWORD = "123456";

function admin_is_logged_in()
{
    return isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true;
}

function require_admin_login()
{
    if (!admin_is_logged_in()) {
        header("Location: login.php");
        exit();
    }
}

function admin_has_order_status_column($conn)
{
    $result = mysqli_query($conn, "SHOW COLUMNS FROM orders LIKE 'status'");
    return $result && mysqli_num_rows($result) > 0;
}
