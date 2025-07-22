<?php
session_start();
require_once('../../config/db.php');

// Fetch all categories
$stmt = $pdo->query("SELECT * FROM categories ORDER BY id DESC");
$categories = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Categories - Free API Vault</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
    <h2>Manage Categories</h2>
    <a href="../dashboard.php">← Back to Dashboard</a> |
    <a href="add.php">+ Add New Category</a>
    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($categories as $cat): ?>
        <tr>
            <td><?= $cat['id'] ?></td>
            <td><?= htmlspecialchars($cat['name']) ?></td>
            <td>
                <a href="edit.php?id=<?= $cat['id'] ?>">Edit</a> |
                <a href="delete.php?id=<?= $cat['id'] ?>" onclick="return confirm('Are you sure?')">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>