<?php

include("bdd.php");

header('Content-Type: application/json'); // Define the response header as JSON

$response = array(); // Initialize the response array

// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Verify if the account exists and log in
if (isset($_POST['email']) && isset($_POST['password'])) {
    // Retrieving form data
    $email = $_POST['email'];
    $password = $_POST['password'];

    // SQL query to verify login information using prepared statements
    $stmt = $conn->prepare("SELECT id, name, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // The user is successfully authenticated
        $row = $result->fetch_assoc();
        $nom_utilisateur = $row['name'];
        $hashed_password = $row['password'];

        // Verify the password
        if (password_verify($password, $hashed_password)) {
            // Start the session and store user information
            session_start();
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['user_name'] = $nom_utilisateur;

            $response = array("success" => true, "message" => "Bienvenue, " . $nom_utilisateur);
        } else {
            // Incorrect password
            $response = array("success" => false, "message" => "Incorrect password. Please try again.");
        }
    } else {
        // The login information is incorrect
        $response = array("success" => false, "message" => "Incorrect email or password. Please try again.");
    }

    // Close the statement
    $stmt->close();
} else {
    // The form data is incomplete
    $response = array("success" => false, "message" => "Please enter an email and a password.");
}

// Close the database connection
$conn->close();

// Send the JSON response to the client
echo json_encode($response);
?>
