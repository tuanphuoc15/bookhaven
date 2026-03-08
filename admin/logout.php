<?php
include __DIR__ . '/_bootstrap.php';
unset($_SESSION['admin_logged_in']);
header('Location: login.php');
exit();
