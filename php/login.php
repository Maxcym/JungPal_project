<?php

include("bdd.php");

header('Content-Type: application/json'); // Définir l'en-tête de la réponse comme JSON

$response = array(); // Initialiser le tableau de réponse

// Verify if the account exists and logs in
if (isset($_POST['email']) && isset($_POST['password'])) {
    // Retrieving form data
    $email = $_POST['email'];
    $password = $_POST['password'];

    // SQL query to verify login information
    $sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // The user is successfully authenticated
        $row = $result->fetch_assoc();
        $nom_utilisateur = $row['name'];

        // Start the session and store user information
        session_start();
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['user_name'] = $nom_utilisateur;
        
        $response = array("success" => true, "message" => "Bienvenue, " . $nom_utilisateur);
    } else {
        
        // The login information is incorrect
        $response = array("success" => false, "message" => "Incorrect informations. Please try again.");
    }
} else {
 
    // The form data is incomplete
    $response = array("success" => false, "message" => "Please enter an email and a password.");
}


// Close the database connection
$conn->close();

// Envoyer la réponse JSON au client
echo json_encode($response);
?>
