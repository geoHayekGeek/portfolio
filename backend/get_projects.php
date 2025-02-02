<?php
require './db.php';

header('Content-Type: application/json');

try {
    // Fetch all projects
    $stmt = $pdo->query("SELECT id, name, image, service_category AS category FROM projects");
    $projects = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Return the result as JSON
    echo json_encode(['rows' => $projects]);
} catch (PDOException $e) {
    // Return error message if a database error occurs
    echo json_encode(['error' => $e->getMessage()]);
}
?>
