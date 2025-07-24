<?php
session_start();
require_once('../../config/db.php');

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

    $stmt = $pdo->prepare("INSERT INTO apis (name, category_id, base_url, auth_type, docs_url, sample_endpoint, logo_url, notes) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([$name, $category_id, $base_url, $auth_type, $docs_url, $sample_endpoint, $logo_url, $notes]);
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add API</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
    <h2>Add New API</h2>
        <nav>
        <a href="index.php">← Back to APIs</a>
    </nav>

    <form method="POST">
        <label for="name">API Name</label>
        <input type="text" id="name" name="name" placeholder="Enter API name" required>

        <label for="category_id">Category</label>
        <select id="category_id" name="category_id" required>
            <option value="">-- Select Category --</option>
            <?php foreach ($cats as $cat): ?>
                <option value="<?= $cat['id'] ?>"><?= htmlspecialchars($cat['name']) ?></option>
            <?php endforeach; ?>
        </select>

        <label for="base_url">Base URL</label>
        <input type="text" id="base_url" name="base_url" placeholder="https://api.example.com" required>

        <label for="auth_type">Authentication Type</label>
        <select id="auth_type" name="auth_type" required>
            <option value="None">None</option>
            <option value="API Key">API Key</option>
            <option value="OAuth">OAuth</option>
        </select>

        <label for="docs_url">Documentation URL</label>
        <input type="text" id="docs_url" name="docs_url" placeholder="https://docs.example.com">

        <label for="sample_endpoint">Sample Endpoint</label>
        <input type="text" id="sample_endpoint" name="sample_endpoint" placeholder="/v1/users">

        <label for="logo_url">Logo URL (optional)</label>
        <input type="text" id="logo_url" name="logo_url" placeholder="https://example.com/logo.png">

        <label for="notes">Notes (optional)</label>
        <textarea id="notes" name="notes" placeholder="Any additional notes about this API"></textarea>

        <button type="submit">Add API</button>
    </form>
</body>
</html>