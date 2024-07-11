<?php
header('Content-Type: application/json');
include("bdd.php");

if (!isset($_GET['id'])) {
    echo json_encode(['success' => false, 'message' => 'Ad ID not provided.']);
    exit;
}

$ad_id = $_GET['id'];

// Get an ad from the database depending on the id
try {
    $stmt = $conn->prepare("SELECT name, surname, dob, rooms, price, size, deposit, internet, campus_time, party, garden, cleaning FROM users JOIN ads ON users.id = ads.user_id WHERE ads.id = ?");
    $stmt->bind_param("i", $ad_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $ad = $result->fetch_assoc();

    if ($ad) {
        echo json_encode(['success' => true] + $ad);
    } else {
        echo json_encode(['success' => false, 'message' => 'Ad not found.']);
    }
    $stmt->close();
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
}

$conn->close();
?>
