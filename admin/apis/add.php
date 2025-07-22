<?php
session_start();
require_once('../../config/db.php');

// Fetch categories for dropdown
$cats = $pdo->query("SELECT * FROM categories")->fetchAll();

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
    <form method="POST">
        <input type="text" name="name" placeholder="API Name" required><br>
        <select name="category_id" required>
            <option value="">-- Select Category --</option>
            <?php foreach ($cats as $cat): ?>
                <option value="<?= $cat['id'] ?>"><?= htmlspecialchars($cat['name']) ?></option>
            <?php endforeach; ?>
        </select><br>
        <input type="text" name="base_url" placeholder="Base URL" required><br>
        <select name="auth_type" required>
            <option value="None">None</option>
            <option value="API Key">API Key</option>
            <option value="OAuth">OAuth</option>
        </select><br>
        <input type="text" name="docs_url" placeholder="Docs Link"><br>
        <input type="text" name="sample_endpoint" placeholder="Sample Endpoint"><br>
        <input type="text" name="logo_url" placeholder="Logo URL (optional)"><br>
        <textarea name="notes" placeholder="Notes (optional)"></textarea><br>
        <button type="submit">Add API</button>
    </form>
    <br><a href="index.php">← Back</a>
</body>
</html>