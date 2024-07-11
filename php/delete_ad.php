<?php
header('Content-Type: application/json');
include("bdd.php");

$input = file_get_contents('php://input');
$data = json_decode($input, true);

session_start();
if (!isset($_SESSION['user_id'])) {
    echo json_encode([
        'success' => false,
        'message' => 'User not logged in.'
    ]);
    exit;
}

$user_id = $_SESSION['user_id'];

if (!$user_id) {
    echo json_encode([
        'success' => false,
        'message' => 'User ID is required.'
    ]);
    exit;
}

// Delete the ad in the database depending on the user who created it
try {
    $stmt = $conn->prepare("DELETE FROM ads WHERE user_id = ?");
    $stmt->bind_param("i", $user_id);
    $success = $stmt->execute();
    $message = $success ? "Ad deleted successfully" : "Error deleting ad: " . $stmt->error;

    $stmt->close();
    $conn->close();

    echo json_encode([
        'success' => $success,
        'message' => $message
    ]);
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Database error: ' . $e->getMessage()
    ]);
    exit;
}
?>
