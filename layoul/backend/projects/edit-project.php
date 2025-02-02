<?php
include_once '../db.php';

// Get data from POST request
$id = isset($_POST['id']) ? (int) $_POST['id'] : 0;
$title = isset($_POST['title']) ? trim($_POST['title']) : '';
$service_name = isset($_POST['service_name']) ? trim($_POST['service_name']) : '';
$description = isset($_POST['description']) ? $_POST['description'] : '';
$image = isset($_POST['image']) ? $_POST['image'] : null;

// Validate and sanitize inputs
if (empty($id) || empty($title) || empty($service_name) || empty($description)) {
    echo json_encode(['status' => 'error', 'message' => 'Missing required fields']);
    exit;
}

$title = htmlspecialchars($title, ENT_QUOTES, 'UTF-8');
$service_name = htmlspecialchars($service_name, ENT_QUOTES, 'UTF-8');
$description = strip_tags($description, '<p><a><strong><em><ul><ol><li><img>'); // Allow safe tags

// Handle image validation and preparation
$imageData = null;
if ($image) {
    // Validate base64 image format
    if (preg_match('/^data:image\/(jpeg|png|gif|webp);base64,/', $image)) {
        $imageData = $image;
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Invalid image format']);
        exit;
    }
}

// Build SQL query to update the project
$sql = "UPDATE projects 
        SET name = :name, service_category = :service_category, content = :content" . 
        ($imageData ? ", image = :image" : "") . 
        " WHERE id = :id";
$stmt = $pdo->prepare($sql);

// Bind parameters to prevent SQL injection
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$stmt->bindParam(':name', $title);
$stmt->bindParam(':service_category', $service_name);
$stmt->bindParam(':content', $description);
if ($imageData) {
    $stmt->bindParam(':image', $imageData, PDO::PARAM_STR);
}

try {
    $stmt->execute();
    if ($stmt->rowCount()) {
        echo json_encode(['status' => 'success', 'message' => 'Project updated successfully']);
        // header('Location: ../../index');
        
    } else {
        echo json_encode(['status' => 'error', 'message' => 'No changes made or project not found']);
    }
} catch (PDOException $e) {
    echo json_encode(['status' => 'error', 'message' => 'Database error: ' . $e->getMessage()]);
}
?>
