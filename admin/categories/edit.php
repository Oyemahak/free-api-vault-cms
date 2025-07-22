<?php
session_start();
require_once('../../config/db.php');

$id = $_GET['id'] ?? null;

if (!$id) {
    header("Location: index.php");
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM categories WHERE id = ?");
$stmt->execute([$id]);
$category = $stmt->fetch();

if (!$category) {
    header("Location: index.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    if (!empty($name)) {
        $update = $pdo->prepare("UPDATE categories SET name = ? WHERE id = ?");
        $update->execute([$name, $id]);
        header("Location: index.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Category</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
    <h2>Edit Category</h2>
    <form method="POST">
        <input type="text" name="name" value="<?= htmlspecialchars($category['name']) ?>" required />
        <button type="submit">Update</button>
    </form>
    <br><a href="index.php">← Back</a>
</body>
</html>