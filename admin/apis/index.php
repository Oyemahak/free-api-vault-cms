<?php
session_start();
require_once('../../config/db.php');

// Fetch all APIs with category name
$stmt = $pdo->query("SELECT apis.*, categories.name AS category FROM apis 
                     LEFT JOIN categories ON apis.category_id = categories.id 
                     ORDER BY apis.id DESC");
$apis = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage APIs</title>
    <link rel="stylesheet" href="../assets/style.css">
    <style>
        .copy-input {
            width: 90%;
            padding: 4px;
            font-size: 0.9rem;
        }

        .copy-btn {
            padding: 4px 8px;
            margin-left: 5px;
            font-size: 0.8rem;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <h2>Manage APIs</h2>
    <a href="../dashboard.php">← Back to Dashboard</a> |
    <a href="add.php">+ Add New API</a>

    <table border="1" cellpadding="10" cellspacing="0">
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
                <a href="edit.php?id=<?= $api['id'] ?>">Edit</a> |
                <a href="delete.php?id=<?= $api['id'] ?>" onclick="return confirm('Are you sure?')">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>

    <script>
    function copyToClipboard(id) {
        const input = document.getElementById(id);
        input.select();
        input.setSelectionRange(0, 99999); // For mobile support
        document.execCommand("copy");
        alert("Copied: " + input.value);
    }
    </script>
</body>
</html>