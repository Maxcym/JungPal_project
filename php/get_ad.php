<?php
header('Content-Type: application/json');
include("bdd.php");

if (!isset($_GET['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'User ID not provided.']);
    exit;
}

$user_id = $_GET['user_id'];

// Get an ad from the database depending on the user_id
try {
    $stmt = $conn->prepare("SELECT name, surname, dob, rooms, price, size, deposit, internet, campus_time, party, garden, cleaning FROM users JOIN ads ON users.id = ads.user_id WHERE users.id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $ad = $result->fetch_assoc();

    if ($ad) {
        echo json_encode(['success' => true] + $ad);
    } else {
        echo json_encode(['success' => false, 'message' => 'Ad not found for the specified user.']);
    }
    $stmt->close();
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
}

$conn->close();
?>
