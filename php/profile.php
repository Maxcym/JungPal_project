<?php
header('Content-Type: application/json');
session_start();

// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include("bdd.php");

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Utilisateur non connecté.']);
    exit;
}

// Get all the user data depending on their id
$user_id = $_SESSION['user_id'];

try {
    $stmt = $conn->prepare("SELECT name, surname, gender, dob, address, city, postal_code, email, password FROM users WHERE id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $profile = $result->fetch_assoc();

    $stmt2 = $conn->prepare("SELECT party, garden, cleaning, rooms, price, size, internet, deposit, campus_time, visible FROM ads WHERE user_id = ?");
    $stmt2->bind_param("i", $user_id);
    $stmt2->execute();
    $result2 = $stmt2->get_result();
    $ads = $result2->fetch_assoc();

    if ($profile && $ads) {
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
            'password' => $profile['password'],
            'party' => $ads['party'],
            'garden' => $ads['garden'],
            'cleaning' => $ads['cleaning'],
            'rooms' => $ads['rooms'],
            'price' => $ads['price'],
            'size' => $ads['size'],
            'internet' => $ads['internet'],
            'deposit' => $ads['deposit'],
            'campus_time' => $ads['campus_time'],
            'visible' => $ads['visible']
        ]);
    } elseif ($profile && !$ads) {
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
