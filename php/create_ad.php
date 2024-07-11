<?php
include("bdd.php");


//filling in all the variables for creating an ad
$party = $_POST['party'];
$garden = $_POST['garden_help'];
$cleaning = $_POST['cleaning'];
$rooms = $_POST['number_of_rooms'];
$price = $_POST['price'];
$area = $_POST['area'];
$internet = $_POST['internet'];
$deposit = $_POST['deposit'];
$campustime = $_POST['campus_time'];
$visible = 0;
$userId = $_POST['userId'];

// The user is successfully authenticated
// SQL query to verify login information
$sql = "INSERT INTO ad(rooms, price, size, internet, deposit, campustime, party, garden, cleaning, visible, user_id) 
VALUES ('$rooms', '$price', '$area', '$internet', '$deposit', '$campustime', '$party', '$garden','$cleaning', '$visible', '$user_id')";
$conn->query($sql);
$response = array("success" => true, "message" => "Compte créer avec succès");


// Close the connexion
$conn->close();

echo json_encode($response);
?>