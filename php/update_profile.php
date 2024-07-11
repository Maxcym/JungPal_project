<?php
header('Content-Type: application/json');
include("bdd.php");
session_start();

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Utilisateur non connecté.']);
    exit;
}

// Update the user profile depending on their id
$user_id = $_SESSION['user_id'];

$name = $_POST['nom'];
$surname = $_POST['prenom'];
$gender = $_POST['Gdr'];
$birth_date = $_POST['birth'];
$address = $_POST['Addr'];
$city = $_POST['Cty'];
$postal_code = $_POST['pc'];
$email = $_POST['email'];
$password = $_POST['password'];

try {
    $stmt = $conn->prepare("UPDATE users SET name = ?, surname = ?, gender = ?, dob = ?, address = ?, city = ?, postal_code = ?, email = ?, password = ? WHERE id = ?");
    $stmt->bind_param("sssssssssi", $name, $surname, $gender, $birth_date, $address, $city, $postal_code, $email, $password, $user_id);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo json_encode(['success' => true, 'message' => 'Profil mis à jour avec succès.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Aucune modification détectée.']);
    }
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Erreur de mise à jour: ' . $e->getMessage()]);
}

$conn->close();
?>
