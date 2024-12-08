<?php
include_once '../db.php';

// Get data from POST request
$title = isset($_POST['title']) ? trim($_POST['title']) : '';
$service_name = isset($_POST['service_name']) ? trim($_POST['service_name']) : '';
$description = isset($_POST['description']) ? $_POST['description'] : '';

// Validate and sanitize inputs
if (empty($title) || empty($service_name) || empty($description)) {
    echo json_encode(['status' => 'error', 'message' => 'Missing required fields']);
    exit;
}

// Sanitize title and service_name to remove unwanted characters
$title = htmlspecialchars($title, ENT_QUOTES, 'UTF-8');
$service_name = htmlspecialchars($service_name, ENT_QUOTES, 'UTF-8');

// Basic XSS sanitization for content (optional but recommended)
$description = strip_tags($description, '<p><a><strong><em><ul><ol><li><img>'); // Allow only safe tags

// Prepare SQL query to insert data
$sql = "INSERT INTO projects (name, service_category, content) VALUES (:name, :service_category, :content)";
$stmt = $pdo->prepare($sql);

// Bind parameters to prevent SQL injection
$stmt->bindParam(':name', $title);
$stmt->bindParam(':service_category', $service_name);
$stmt->bindParam(':content', $description);

try {
    $stmt->execute();
    echo json_encode(['status' => 'success']);
} catch (PDOException $e) {
    echo json_encode(['status' => 'error', 'message' => 'Database error: ' . $e->getMessage()]);
}
?>
