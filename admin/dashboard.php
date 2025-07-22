<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit;
}

// Get counts for dashboard
require_once('../config/db.php');
$apiCount = $pdo->query("SELECT COUNT(*) FROM apis")->fetchColumn();
$catCount = $pdo->query("SELECT COUNT(*) FROM categories")->fetchColumn();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard - Free API Vault</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <h1>Admin Dashboard</h1>
    <nav>
        <a href="categories/index.php">Manage Categories</a>
        <a href="apis/index.php">Manage APIs</a>
        <a href="logout.php">Logout</a>
    </nav>

    <div class="dashboard-container">
        <div class="dashboard-card">
            <h3>Total APIs</h3>
            <p style="font-size: 2.5rem; margin: 10px 0;"><?= $apiCount ?></p>
            <a href="apis/index.php" class="btn">View All</a>
        </div>
        
        <div class="dashboard-card">
            <h3>Total Categories</h3>
            <p style="font-size: 2.5rem; margin: 10px 0;"><?= $catCount ?></p>
            <a href="categories/index.php" class="btn">View All</a>
        </div>
    </div>
</body>
</html>