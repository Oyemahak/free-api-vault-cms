<?php
session_start();
require_once('../../config/db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    if (!empty($name)) {
        $stmt = $pdo->prepare("INSERT INTO categories (name) VALUES (?)");
        $stmt->execute([$name]);
        header("Location: index.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Category</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
    <h2>Add New Category</h2>
        <nav>
        <a href="index.php">← Back to Categories</a>
    </nav>
    <form method="POST">
        <input type="text" name="name" placeholder="Category Name" required />
        <button type="submit">Add</button>
    </form>
</body>
</html>