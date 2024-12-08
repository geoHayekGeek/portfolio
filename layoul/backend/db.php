<?php
// db.php - Secure database connection file

$host = 'localhost';
$dbname = 'lea_portfolio';
$username = 'root';
$password = '';
$dsn = "mysql:host=$host;dbname=$dbname;charset=utf8";

try {
    // Using PDO for secure database connection
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    // Log the error message and provide a generic message
    error_log($e->getMessage());
    die("Something went wrong. Please try again later.");
}
?>
