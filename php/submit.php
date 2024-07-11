<?php
include("bdd.php");

// Fonction de débogage
function debug_to_console($data) {
    $output = $data;
    if (is_array($output))
        $output = implode(',', $output);

    echo "<script>console.log('Debug: " . $output . "' );</script>";
}

$ad_id = isset($_POST['id']) ? $_POST['id'] : null;
$user_id = isset($_POST['user_id']) ? $_POST['user_id'] : null;
$party = isset($_POST['party']) ? $_POST['party'] : null;
$garden = isset($_POST['garden']) ? $_POST['garden'] : null;
$cleaning = isset($_POST['cleaning']) ? $_POST['cleaning'] : null;
$rooms = isset($_POST['rooms']) ? $_POST['rooms'] : null;
$price = isset($_POST['price']) ? $_POST['price'] : null;
$size = isset($_POST['size']) ? $_POST['size'] : null;
$internet = isset($_POST['internet']) ? $_POST['internet'] : null;
$deposit = isset($_POST['deposit']) ? $_POST['deposit'] : null;
$campus_time = isset($_POST['campus-time']) ? $_POST['campus-time'] : null;

// Log des valeurs avant la requête
debug_to_console("user_id: $user_id");
debug_to_console("party: $party");
debug_to_console("garden: $garden");
debug_to_console("cleaning: $cleaning");
debug_to_console("rooms: $rooms");
debug_to_console("price: $price");
debug_to_console("size: $size");
debug_to_console("internet: $internet");
debug_to_console("deposit: $deposit");
debug_to_console("campus_time: $campus_time");

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
