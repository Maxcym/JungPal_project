<?php
header('Content-Type: application/json');
include("bdd.php");
session_start();

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Utilisateur non connecté.']);
    exit;
}

$user_id = $_SESSION['user_id'];

try {
    $stmt = $conn->prepare("SELECT name, surname, gender, dob, address, city, postal_code, email, password FROM users WHERE id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $profile = $result->fetch_assoc();

    if ($profile) {
        echo json_encode([
            'success' => true,
            'name' => $profile['name'],
            'surname' => $profile['surname'],
            'gender' => $profile['gender'],
            'birth_date' => $profile['dob'],
            'address' => $profile['address'],
            'city' => $profile['city'],
            'postal_code' => $profile['postal_code'],
            'email' => $profile['email'],
            'password' => $profile['password']
        ]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Profil non trouvé.']);
    }
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Erreur de connexion à la base de données: ' . $e->getMessage()]);
}

$conn->close();
?>
