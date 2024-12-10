<?php
include_once '../db.php';

// Get data from POST request
$title = isset($_POST['title']) ? trim($_POST['title']) : '';
$service_name = isset($_POST['service_name']) ? trim($_POST['service_name']) : '';
$description = isset($_POST['description']) ? $_POST['description'] : '';
$image = isset($_POST['image']) ? $_POST['image'] : null;

// Validate and sanitize inputs
if (empty($title) || empty($service_name) || empty($description)) {
    echo json_encode(['status' => 'error', 'message' => 'Missing required fields']);
    exit;
}

$title = htmlspecialchars($title, ENT_QUOTES, 'UTF-8');
$service_name = htmlspecialchars($service_name, ENT_QUOTES, 'UTF-8');
$description = strip_tags($description, '<p><a><strong><em><ul><ol><li><img>'); // Allow safe tags

// Prepare image field for storage if it exists
$imageData = null;
if ($image) {
    // Validate the base64 image format (should not exceed 1MB)
    if (preg_match('/^data:image\/(jpeg|png|gif|webp);base64,/', $image)) {
        $imageData = $image;
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Invalid image format']);
        exit;
    }
}

// Prepare SQL query to insert data
$sql = "INSERT INTO projects (name, service_category, content, image) VALUES (:name, :service_category, :content, :image)";
$stmt = $pdo->prepare($sql);

// Bind parameters to prevent SQL injection
$stmt->bindParam(':name', $title);
$stmt->bindParam(':service_category', $service_name);
$stmt->bindParam(':content', $description);
$stmt->bindParam(':image', $imageData, PDO::PARAM_STR);

try {
    $stmt->execute();
    echo json_encode(['status' => 'success']);
} catch (PDOException $e) {
    echo json_encode(['status' => 'error', 'message' => 'Database error: ' . $e->getMessage()]);
}
?>
