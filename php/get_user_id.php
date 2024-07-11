<?php
header('Content-Type: application/json');
session_start();

// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (isset($_SESSION['user_id'])) {
    echo json_encode([
        'success' => true,
        'user_id' => $_SESSION['user_id']
    ]);
} else {
    echo json_encode([
        'success' => false,
        'message' => 'Utilisateur non connecté.'
    ]);
}
?>
