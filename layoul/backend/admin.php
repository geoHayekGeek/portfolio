<?php
// admin.php - Admin Dashboard Access

session_start();

// Check if the user is logged in and is an admin
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
    // Redirect to login page if not logged in or not an admin
    header('Location: ./login');
    exit;
}

?>
