<?php
require_once('../config/db.php');

// Fetch all categories
$catStmt = $pdo->query("SELECT * FROM categories");
$categories = $catStmt->fetchAll();

// Filter logic
$filter = $_GET['category'] ?? null;

if ($filter) {
    $stmt = $pdo->prepare("SELECT apis.*, categories.name AS category_name FROM apis 
                           JOIN categories ON apis.category_id = categories.id 
                           WHERE apis.category_id = ?
                           ORDER BY apis.id DESC");
    $stmt->execute([$filter]);
} else {
    $stmt = $pdo->query("SELECT apis.*, categories.name AS category_name FROM apis 
                         JOIN categories ON apis.category_id = categories.id 
                         ORDER BY apis.id DESC");
}

$apis = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Free API Vault</title>
    <link rel="stylesheet" href="assets/style.css">
    <script src="assets/script.js" defer></script>
</head>
<body>
    <header>
        <h1>Free API Vault</h1>
        <p>Explore categorized free APIs for your development projects.</p>
    </header>

    <div class="filters">
        <form method="GET">
            <select name="category" onchange="this.form.submit()">
                <option value="">-- Filter by Category --</option>
                <?php foreach ($categories as $cat): ?>
                    <option value="<?= $cat['id'] ?>" <?= $filter == $cat['id'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($cat['name']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </form>
    </div>

    <div class="api-container">
        <?php if (count($apis)): ?>
            <?php foreach ($apis as $api): ?>
                <div class="api-card">
                    <h3><?= htmlspecialchars($api['name']) ?></h3>

                    <?php if (!empty($api['notes'])): ?>
                        <p><?= nl2br(htmlspecialchars($api['notes'])) ?></p>
                    <?php endif; ?>

                    <p><strong>Category:</strong> <?= htmlspecialchars($api['category_name']) ?></p>
                    <p><strong>Base URL:</strong> <a href="<?= htmlspecialchars($api['base_url']) ?>" target="_blank" rel="noopener noreferrer"><?= htmlspecialchars($api['base_url']) ?></a></p>

                    <div class="btns">
                        <a href="<?= $api['docs_url'] ?>" target="_blank">View Docs</a>
                        <button onclick="copyText('<?= $api['base_url'] . $api['sample_endpoint'] ?>')">Copy Endpoint</button>
                        <a href="api-details.php?id=<?= $api['id'] ?>">Details</a>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="no-results">No APIs found for this category.</p>
        <?php endif; ?>
    </div>
</body>
</html>