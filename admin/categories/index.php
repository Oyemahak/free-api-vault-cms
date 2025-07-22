<?php
session_start();
require_once('../../config/db.php');

// Fetch all categories ordered by ID ASC
$stmt = $pdo->query("SELECT * FROM categories ORDER BY id ASC");
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
    <nav>
        <a href="../dashboard.php">← Back to Dashboard</a>
        <a href="add.php">+ Add New Category</a>
    </nav>

    <?php if (count($categories) > 0): ?>
        <table>
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
                    <a href="edit.php?id=<?= $cat['id'] ?>" class="btn">Edit</a>
                    <a href="delete.php?id=<?= $cat['id'] ?>" onclick="return confirm('Are you sure?')" class="btn" style="background: #e74c3c;">Delete</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    <?php else: ?>
        <p>No categories found. <a href="add.php">Add your first category</a></p>
    <?php endif; ?>
</body>
</html>