<?php
require_once('../config/db.php');

// Check for API ID in URL
$id = $_GET['id'] ?? null;
if (!$id) {
    header("Location: index.php");
    exit;
}

// Fetch the API by ID
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
<html>
<head>
    <title><?= htmlspecialchars($api['name']) ?> - API Details</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <div class="details-page">
        <h2><?= htmlspecialchars($api['name']) ?></h2>
        <p><strong>Category:</strong> <?= htmlspecialchars($api['category_name']) ?></p>
        <p><strong>Base URL:</strong> <?= $api['base_url'] ?></p>
        <p><strong>Auth Type:</strong> <?= $api['auth_type'] ?></p>
        <p><strong>Sample Endpoint:</strong> <?= $api['sample_endpoint'] ?></p>
        <p><strong>Docs:</strong> <a href="<?= $api['docs_url'] ?>" target="_blank">Open Documentation</a></p>
        
        <button onclick="copyText('<?= $api['base_url'] . $api['sample_endpoint'] ?>')">Copy Full Endpoint</button>

        <?php if (!empty($api['notes'])): ?>
            <h4>Notes:</h4>
            <p><?= nl2br(htmlspecialchars($api['notes'])) ?></p>
        <?php endif; ?>

        <br><br>
        <a href="index.php">← Back to All APIs</a>
    </div>

    <script src="assets/script.js"></script>
</body>
</html>