<?php
// logout.php - User Logout

session_start();
session_unset(); // Unset session variables
session_destroy(); // Destroy session
echo json_encode(["message" => "Logged out successfully."]);
?>
