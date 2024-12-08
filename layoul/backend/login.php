<?php
// login.php - User Login with Security

session_start();
require_once 'db.php';
require_once 'functions.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize and validate inputs
    $username = filter_var(sanitizeInput($_POST['username']), FILTER_SANITIZE_STRING);
    $password = $_POST['password'];
    $csrf_token = $_POST['csrf_token'];

    // Validate CSRF token
    if (!validateCSRFToken($csrf_token)) {
        echo json_encode([
            "success" => false,
            "message" => "CSRF token validation failed"
        ]);
        exit;
    }

    // Check if username exists
    $sql = "SELECT * FROM users WHERE username = :username";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    $user = $stmt->fetch();

    // Verify password
    if ($user && password_verify($password, $user['password'])) {
        // Regenerate session ID to prevent session fixation
        session_regenerate_id(true);

        // Store user information in session
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_role'] = $user['role'];
        $_SESSION['username'] = $user['username'];

        // Return a success message with success flag
        echo json_encode([
            "success" => true,
            "message" => "Login successful.",
            "redirect" => "./index",
            "ok" => true,
        ]);
        exit;
    } else {
        // Return a failure message with success flag
        echo json_encode([
            "success" => false,
            "message" => "Invalid login credentials."
        ]);
        exit;
    }
} else {
    // Handle invalid request method
    echo json_encode([
        "success" => false,
        "message" => "Something went wrong."
    ]);
    exit;
}
?>