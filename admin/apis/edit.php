<?php
session_start();
require_once('../../config/db.php');

$id = $_GET['id'] ?? null;
if (!$id) header("Location: index.php");

$stmt = $pdo->prepare("SELECT * FROM apis WHERE id = ?");
$stmt->execute([$id]);
$api = $stmt->fetch();

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
    <form method="POST">
        <input type="text" name="name" value="<?= htmlspecialchars($api['name']) ?>" required><br>
        <select name="category_id" required>
            <option value="">-- Select Category --</option>
            <?php foreach ($cats as $cat): ?>
                <option value="<?= $cat['id'] ?>" <?= $cat['id'] == $api['category_id'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($cat['name']) ?>
                </option>
            <?php endforeach; ?>
        </select><br>
        <input type="text" name="base_url" value="<?= htmlspecialchars($api['base_url']) ?>" required><br>
        <select name="auth_type" required>
            <option value="None" <?= $api['auth_type'] === 'None' ? 'selected' : '' ?>>None</option>
            <option value="API Key" <?= $api['auth_type'] === 'API Key' ? 'selected' : '' ?>>API Key</option>
            <option value="OAuth" <?= $api['auth_type'] === 'OAuth' ? 'selected' : '' ?>>OAuth</option>
        </select><br>
        <input type="text" name="docs_url" value="<?= htmlspecialchars($api['docs_url']) ?>"><br>
        <input type="text" name="sample_endpoint" value="<?= htmlspecialchars($api['sample_endpoint']) ?>"><br>
        <input type="text" name="logo_url" value="<?= htmlspecialchars($api['logo_url']) ?>"><br>
        <textarea name="notes"><?= htmlspecialchars($api['notes']) ?></textarea><br>
        <button type="submit">Update API</button>
    </form>
    <br><a href="index.php">← Back</a>
</body>
</html>