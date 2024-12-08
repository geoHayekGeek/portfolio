<?php
// csrf_token.php - Generate CSRF Token

session_start();
require_once 'functions.php';
echo json_encode(["csrf_token" => generateCSRFToken()]);
?>
