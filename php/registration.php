<?php
include("bdd.php");


// Filling in all the variables for account creation
$name = $_POST['nom'];
$surname = $_POST['prenom'];
$gender = $_POST['Gdr'];
$dob = $_POST['birth'];
$address = $_POST['Addr'];
$city = $_POST['Cty'];
$postal_code = $_POST['pc'];
$email = $_POST['email'];
$password = $_POST['password'];

// SQL query to verify login information
$sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
        // The account already exists
        $response = array("success" => false);
} else {
        // The user is successfully authenticated
        // SQL query to verify login information
        $sql = "INSERT INTO users(name, surname, gender, dob, address, city, postal_code, email, password) VALUES ('$name', '$surname', '$gender', '$dob', '$address', '$city', '$postal_code', '$email', '$password')";
        $conn->query($sql);
        $response = array("success" => true, "message" => "Compte créer avec succès");

}

// Close the database connection
$conn->close();

echo json_encode($response);
?>
