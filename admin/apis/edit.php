<?php
session_start();
require_once('../../config/db.php');

$id = $_GET['id'] ?? null;
if (!$id) header("Location: index.php");

$stmt = $pdo->prepare("SELECT * FROM apis WHERE id = ?");
$stmt->execute([$id]);
$api = $stmt->fetch();

// Fetch categories for dropdown ordered by ID ASC
$cats = $pdo->query("SELECT * FROM categories ORDER BY id ASC")->fetchAll();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $category_id = $_POST['category_id'];
    $base_url = $_POST['base_url'];
    $auth_type = $_POST['auth_type'];
    $docs_url = $_POST['docs_url'];
    $sample_endpoint = $_POST['sample_endpoint'];
    $logo_url = $_POST['logo_url'];
    $notes = $_POST['notes'];

    $stmt = $pdo->prepare("UPDATE apis SET name=?, category_id=?, base_url=?, auth_type=?, docs_url=?, sample_endpoint=?, logo_url=?, notes=? WHERE id=?");
    $stmt->execute([$name, $category_id, $base_url, $auth_type, $docs_url, $sample_endpoint, $logo_url, $notes, $id]);
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit API</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
    <h2>Edit API</h2>
    <nav>
        <a href="index.php">← Back to APIs</a>
    </nav>

    <form method="POST">
        <label for="name">API Name</label>
        <input type="text" id="name" name="name" value="<?= htmlspecialchars($api['name']) ?>" required>

        <label for="category_id">Category</label>
        <select id="category_id" name="category_id" required>
            <option value="">-- Select Category --</option>
            <?php foreach ($cats as $cat): ?>
                <option value="<?= $cat['id'] ?>" <?= $cat['id'] == $api['category_id'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($cat['name']) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label for="base_url">Base URL</label>
        <input type="text" id="base_url" name="base_url" value="<?= htmlspecialchars($api['base_url']) ?>" required>

        <label for="auth_type">Authentication Type</label>
        <select id="auth_type" name="auth_type" required>
            <option value="None" <?= $api['auth_type'] === 'None' ? 'selected' : '' ?>>None</option>
            <option value="API Key" <?= $api['auth_type'] === 'API Key' ? 'selected' : '' ?>>API Key</option>
            <option value="OAuth" <?= $api['auth_type'] === 'OAuth' ? 'selected' : '' ?>>OAuth</option>
        </select>

        <label for="docs_url">Documentation URL</label>
        <input type="text" id="docs_url" name="docs_url" value="<?= htmlspecialchars($api['docs_url']) ?>">

        <label for="sample_endpoint">Sample Endpoint</label>
        <input type="text" id="sample_endpoint" name="sample_endpoint" value="<?= htmlspecialchars($api['sample_endpoint']) ?>">

        <label for="logo_url">Logo URL (optional)</label>
        <input type="text" id="logo_url" name="logo_url" value="<?= htmlspecialchars($api['logo_url']) ?>">

        <label for="notes">Notes (optional)</label>
        <textarea id="notes" name="notes"><?= htmlspecialchars($api['notes']) ?></textarea>

        <button type="submit">Update API</button>
    </form>
</body>
</html>