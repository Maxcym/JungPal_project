<?php
include("bdd.php");

// Initialize the response variables
$success = false;
$message = '';

// Retrieve data from POST request
$input = file_get_contents('php://input');
$data = json_decode($input, true);

// Check if required fields are present
$ad_id = isset($data['ad_id']) ? $data['ad_id'] : null;
$user_id = isset($data['user_id']) ? $data['user_id'] : null;
$party = isset($data['party']) ? $data['party'] : '';
$garden = isset($data['garden']) ? $data['garden'] : '';
$cleaning = isset($data['cleaning']) ? $data['cleaning'] : '';
$rooms = isset($data['rooms']) ? $data['rooms'] : '';
$price = isset($data['price']) ? $data['price'] : '';
$size = isset($data['size']) ? $data['size'] : '';
$internet = isset($data['internet']) ? $data['internet'] : '';
$deposit = isset($data['deposit']) ? $data['deposit'] : '';
$campus_time = isset($data['campus_time']) ? $data['campus_time'] : '';

if ($ad_id && $user_id) {
    // Update existing ad
    try {
        $stmt = $conn->prepare("UPDATE ads SET party=?, garden=?, cleaning=?, rooms=?, price=?, size=?, internet=?, deposit=?, campus_time=? WHERE id=? AND user_id=?");
        if ($stmt) {
            $stmt->bind_param("ssssssssssi", $party, $garden, $cleaning, $rooms, $price, $size, $internet, $deposit, $campus_time, $ad_id, $user_id);
            $stmt->execute();
            if ($stmt->affected_rows > 0) {
                $success = true;
                $message = "Ad updated successfully";
            } else {
                $message = "No rows were updated. Ad might not exist or user does not have permission.";
            }
            $stmt->close();
        } else {
            $message = "Failed to prepare the SQL statement.";
        }
    } catch (Exception $e) {
    
