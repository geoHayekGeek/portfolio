<?php
require '../db.php';

header('Content-Type: application/json');

// Get project ID from the query string
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id > 0) {
    try {
        $stmt = $pdo->prepare("SELECT * FROM projects WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $project = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($project) {
            // Send the project data
            echo json_encode([
                'success' => true,
                'project' => [
                    'name' => $project['name'],
                    'service_category' => $project['service_category'],
                    'content' => $project['content'], // Already HTML
                    'image' => $project['image'], // Base64
                ]
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Project not found.'
            ]);
        }
    } catch (PDOException $e) {
        echo json_encode([
            'success' => false,
            'message' => 'Database error: ' . $e->getMessage()
        ]);
    }
} else {
    echo json_encode([
        'success' => false,
        'message' => 'Invalid project ID.'
    ]);
}
?>
