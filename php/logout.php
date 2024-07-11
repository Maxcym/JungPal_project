<?php
session_start();

// Destroy the data session
$_SESSION = array();

// Delete cookies
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Destroy the session
session_unset();
session_destroy();

// Send a response for success
$response = array("success" => true);
header('Content-Type: application/json');
echo json_encode($response);

?>
