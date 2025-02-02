<?php
require './backend/db.php';

$sql = "CREATE TABLE IF NOT EXISTS projects (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL UNIQUE,
    service_category VARCHAR(100) NOT NULL,
    content LONGTEXT NOT NULL,
    image TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

try {
    $pdo->exec($sql);
    echo "Table 'projects' created successfully.";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>