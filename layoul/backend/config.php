<?php
// config.php - Secure Session Settings

ini_set('session.cookie_secure', 1);  // Use HTTPS
ini_set('session.cookie_httponly', 1);  // Prevent JS access to session cookies
ini_set('session.use_strict_mode', 1);  // Enable strict session mode
ini_set('session.sid_length', 48);  // Increase session ID length for better security

session_start();
?>
