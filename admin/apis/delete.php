<?php
session_start();
require_once('../../config/db.php');

$id = $_GET['id'] ?? null;
if ($id) {
    $stmt = $pdo->prepare("DELETE FROM apis WHERE id = ?");
    $stmt->execute([$id]);
}
header("Location: index.php");
exit;