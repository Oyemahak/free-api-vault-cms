<?php
session_start();
require_once('../../config/db.php');

// Fetch all APIs with category name ordered by ID ASC
$stmt = $pdo->query("SELECT apis.*, categories.name AS category FROM apis 
                     LEFT JOIN categories ON apis.category_id = categories.id 
                     ORDER BY apis.id ASC");
$apis = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage APIs</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
    <h2>Manage APIs</h2>
    <nav>
        <a href="../dashboard.php">← Back to Dashboard</a>
        <a href="add.php">+ Add New API</a>
    </nav>

    <?php if (count($apis) > 0): ?>
        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Category</th>
                <th>Auth Type</th>
                <th>Full API Endpoint</th>
                <th>Actions</th>
            </tr>
            <?php foreach ($apis as $api): ?>
            <tr>
                <td><?= $api['id'] ?></td>
                <td><?= htmlspecialchars($api['name']) ?></td>
                <td><?= htmlspecialchars($api['category']) ?></td>
                <td><?= htmlspecialchars($api['auth_type']) ?></td>
                <td>
                    <?php 
                        $fullUrl = $api['base_url'] . $api['sample_endpoint'];
                        $inputId = 'copy-' . $api['id'];
                    ?>
                    <input type="text" value="<?= htmlspecialchars($fullUrl) ?>" id="<?= $inputId ?>" class="copy-input" readonly>
                    <button class="copy-btn" onclick="copyToClipboard('<?= $inputId ?>')">Copy</button>
                </td>
                <td>
                    <a href="edit.php?id=<?= $api['id'] ?>" class="btn">Edit</a>
                    <a href="delete.php?id=<?= $api['id'] ?>" onclick="return confirm('Are you sure?')" class="btn" style="background: #e74c3c;">Delete</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    <?php else: ?>
        <p>No APIs found. <a href="add.php">Add your first API</a></p>
    <?php endif; ?>

    <script>
    function copyToClipboard(id) {
        const input = document.getElementById(id);
        input.select();
        input.setSelectionRange(0, 99999);
        document.execCommand("copy");
        alert("Copied: " + input.value);
    }
    </script>
</body>
</html>