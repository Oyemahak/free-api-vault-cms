<?php
require_once('../config/db.php');

$id = $_GET['id'] ?? null;
if (!$id) {
    header("Location: index.php");
    exit;
}

$stmt = $pdo->prepare("SELECT apis.*, categories.name AS category_name FROM apis 
                       LEFT JOIN categories ON apis.category_id = categories.id 
                       WHERE apis.id = ?");
$stmt->execute([$id]);
$api = $stmt->fetch();

if (!$api) {
    echo "<h2>API not found.</h2>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($api['name']) ?> - API Details</title>
    <link rel="stylesheet" href="assets/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <header>
        <h1>API Details</h1>
        <p>Explore detailed information about this API endpoint.</p>
    </header>

    <div class="api-container">
        <div class="api-card">
            <h3><?= htmlspecialchars($api['name']) ?></h3>
                                <?php if (!empty($api['notes'])): ?>
                        <p><?= nl2br(htmlspecialchars($api['notes'])) ?></p>
                    <?php endif; ?>

            <p><strong>Category:</strong> <?= htmlspecialchars($api['category_name']) ?></p>
            <p><strong>Auth Type:</strong> <?= htmlspecialchars($api['auth_type']) ?></p>

            <p><strong>Base URL:</strong> 
                <a href="<?= htmlspecialchars($api['base_url']) ?>" target="_blank" rel="noopener noreferrer" style="color: #58a6ff; text-decoration: none;">
                    <?= htmlspecialchars($api['base_url']) ?>
                </a>
            </p>

            <p><strong>Sample Endpoint:</strong></p>
            <div class="endpoint"><?= htmlspecialchars($api['sample_endpoint']) ?></div>

            <p><strong>Docs:</strong> 
                <a href="<?= htmlspecialchars($api['docs_url']) ?>" target="_blank" rel="noopener noreferrer" style="color: #58a6ff; text-decoration: none;">
                    Open Documentation
                </a>
            </p>

            <div class="btns">
                <button onclick="copyText('<?= $api['base_url'] . $api['sample_endpoint'] ?>')">Copy Endpoint</button>
                <a href="index.php">← Back to All APIs</a>
            </div>
        </div>
    </div>

    <script src="assets/script.js"></script>
</body>
</html>