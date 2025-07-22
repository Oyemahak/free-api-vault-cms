<?php
// Database connection settings
$host = 'localhost';
$db   = 'free_api_vault';
$user = 'root';
$pass = ''; // Default password for XAMPP is empty
$charset = 'utf8mb4';

try {
    // Create PDO connection
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=$charset", $user, $pass);

    // Set error mode to exception for better debugging
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    // Display error if connection fails
    die("❌ Database connection failed: " . $e->getMessage());
}
?>