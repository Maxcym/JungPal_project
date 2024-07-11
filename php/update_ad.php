<?php
include("bdd.php");

// Initialize the response variables
$success = false;
$message = '';

// Récupération des données POST avec vérification de leur existence
$ad_id = isset($_POST['ad_id']) ? $_POST['ad_id'] : null;
$user_id = isset($_POST['user_id']) ? $_POST['user_id'] : null;
$party = isset($_POST['party']) ? $_POST['party'] : '';
$garden = isset($_POST['garden']) ? $_POST['garden'] : '';
$cleaning = isset($_POST['cleaning']) ? $_POST['cleaning'] : '';
$rooms = isset($_POST['rooms']) ? $_POST['rooms'] : '';
$price = isset($_POST['price']) ? $_POST['price'] : '';
$size = isset($_POST['size']) ? $_POST['size'] : '';
$internet = isset($_POST['internet']) ? $_POST['internet'] : '';
$deposit = isset($_POST['deposit']) ? $_POST['deposit'] : '';
$campus_time = isset($_POST['campus_time']) ? $_POST['campus_time'] : '';

if ($ad_id && $user_id) {
    // Update existing ad
    $stmt = $conn->prepare("UPDATE ads SET party=?, garden=?, cleaning=?, rooms=?, price=?, size=?, internet=?, deposit=?, campus_time=? WHERE ad_id=? AND user_id=?");
    if ($stmt) {
        $stmt->bind_param("sssssssssis", $party, $garden, $cleaning, $rooms, $price, $size, $internet, $deposit, $campus_time, $ad_id, $user_id);
        $success = $stmt->execute();
        $message = $success ? "Ad updated successfully" : "Error updating ad: " . $stmt->error;
        $stmt->close();
    } else {
        $message = "Failed to prepare the SQL statement.";
    }
} else {
    $message = $ad_id ? "User ID is missing." : "Ad ID is missing.";
}

$conn->close();

echo json_encode([
    'success' => $success,
    'message' => $message
]);
?>
