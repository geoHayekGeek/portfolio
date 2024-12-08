<?php
// register.php - User Registration with Security

session_start();
require_once 'db.php';
require_once 'functions.php';
$_SESSION['csrf_token'] = "7ee98248402585708a3a86ad7cdb93d4c573615896ca48fcc71de5a315f63f5d";


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize and validate inputs
    $name = sanitizeInput($_POST['name']);
    $username = filter_var(sanitizeInput($_POST['username']), FILTER_SANITIZE_STRING);
    $email = filter_var(sanitizeInput($_POST['email']), FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];
    $csrf_token = $_POST['csrf_token'];

    // Validate CSRF token
    if (!validateCSRFToken($csrf_token)) {
        die('CSRF token validation failed');
    }

    // Password hashing
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Prepare and execute query with PDO
    $sql = "INSERT INTO users (name, email, username, password, role) VALUES (:name, :email, :username, :password, 'admin')";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $hashedPassword);

    try {
        $stmt->execute();
        echo json_encode(["message" => "User registered successfully."]);
    } catch (PDOException $e) {
        error_log($e->getMessage());
        echo json_encode(["message" => "Registration failed."]);
    }
}
?>
