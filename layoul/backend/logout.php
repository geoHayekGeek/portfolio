<?php
// logout.php - User Logout

session_start();
session_unset(); // Unset session variables
session_destroy(); // Destroy session
header('Location: ../login');
?>
