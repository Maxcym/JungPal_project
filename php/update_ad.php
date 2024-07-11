<?php
header('Content-Type: application/json');
include("bdd.php");

// Initialize the response variables
$success = false;
$message = '';

// Retrieve data from POST request
$input = file_get_contents('php://input');
$data = json_decode($input, true);

// Retrieve user_id and ad details from formData
$user_id = isset($data['user_id']) ? $data['user_id'];
$party = isset($data['party']) ? $data['party'] : '';
$garden = isset($data['garden']) ? $data['garden'] : '';
$cleaning = isset($data['cleaning']) ? $data['cleaning'] : '';
$rooms = isset($data['rooms']) ? $data['rooms'] : '';
$price = isset($data['price']) ? $data['price'] : '';
$size = isset($data['size']) ? $data['size'] : '';
$internet = isset($data['internet']) ? $data['internet'] : '';
$deposit = isset($data['deposit']) ? $data['deposit'] : '';
$campus_time = isset($data['campus_time']) ? $data['campus_time'] : '';

if ($user_id) {
    // Update existing ad
    $stmt = $conn->prepare("UPDATE ads SET party=?, garden=?, cleaning=?, rooms=?, price=?, size=?, internet=?, deposit=?, campus_time=? WHERE user_id=?");
    if ($stmt) {
        $stmt->bind_param("ssssssssii", $party, $garden, $cleaning, $rooms, $price, $size, $internet, $deposit, $campus_time, $user_id);
        $success = $stmt->execute();
        $message = $success ? "Ad updated successfully" : "Error updating ad: " . $stmt->error;
        $stmt->close();
    } else {
        $message = "Failed to prepare the SQL statement.";
    }
} else {
    $message = "User ID or Ad ID is missing.";
}

$conn->close();

echo json_encode([
    'success' => $success,
    'message' => $message
]);
?>
