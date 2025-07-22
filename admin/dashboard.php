<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard - Free API Vault</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <h1>Welcome to Admin Dashboard</h1>
    <nav>
        <a href="categories/index.php">Manage Categories</a> |
        <a href="apis/index.php">Manage APIs</a> |
        <a href="logout.php">Logout</a>
    </nav>
</body>
</html>