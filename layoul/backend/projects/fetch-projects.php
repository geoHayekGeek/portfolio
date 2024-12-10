<?php
require '../db.php';

header('Content-Type: application/json');

try {
    $stmt = $pdo->query("SELECT id, name, image, service_category AS category FROM projects");
    $projects = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode(['rows' => $projects]);
} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>
