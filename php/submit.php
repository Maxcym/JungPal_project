<?php
include("bdd.php");

$ad_id = isset($_POST['ad_id']) ? $_POST['ad_id'] : null;
$user_id = $_POST['user_id'];
$party = $_POST['party'];
$garden = $_POST['garden'];
$cleaning = $_POST['cleaning'];
$rooms = $_POST['rooms'];
$price = $_POST['price'];
$size = $_POST['size'];
$internet = $_POST['internet'];
$deposit = $_POST['deposit'];
$campus_time = $_POST['campus-time'];

echo $user_id;
if ($ad_id) {
    // Update existing ad
    $stmt = $conn->prepare("UPDATE ads SET user_id=?, party=?, garden=?, cleaning=?, rooms=?, price=?, size=?, internet=?, deposit=?, campus_time=? WHERE id=?");
    $stmt->bind_param("isssidsssii", $user_id, $party, $garden, $cleaning, $rooms, $price, $size, $internet, $deposit, $campus_time, $ad_id);
    $success = $stmt->execute();
    $message = $success ? "Ad updated successfully" : "Error updating ad: " . $stmt->error;
} else {
    // Insert new ad
    $stmt = $conn->prepare("INSERT INTO ads (user_id, party, garden, cleaning, rooms, price, size, internet, deposit, campus_time) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("isssidsssi", $user_id, $party, $garden, $cleaning, $rooms, $price, $size, $internet, $deposit, $campus_time);
    $success = $stmt->execute();
    $message = $success ? "New ad created successfully" : "Error creating ad: " . $stmt->error;
    $ad_id = $stmt->insert_id;
}

$stmt->close();
$conn->close();

echo json_encode([
    'success' => $success,
    'message' => $message,
    'ad_id' => $ad_id
]);
?>
