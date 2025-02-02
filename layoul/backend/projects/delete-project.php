<?php
require '../db.php'; // Make sure the db.php file is included

if (isset($_GET['id'])) {
    $projectId = $_GET['id'];

    // Prepare the SQL query to delete the project by its ID
    $sql = "DELETE FROM projects WHERE id = :id";

    try {
        // Prepare the statement
        $stmt = $pdo->prepare($sql);

        // Bind the ID to the query
        $stmt->bindParam(':id', $projectId, PDO::PARAM_INT);

        // Execute the query
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            echo "Project with ID $projectId has been deleted successfully.";
            header('Location: ../../projects.php');
        } else {
            echo "No project found with ID $projectId.";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "No project ID provided.";
}
?>
