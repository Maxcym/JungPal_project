<?php
header('Content-Type: application/json');
include("bdd.php");

// Get all the ads from the database
try {
    $stmt = $conn->prepare("SELECT * FROM ads");
    $stmt->execute();
    $result = $stmt->get_result();
    $ads = $result->fetch_all(MYSQLI_ASSOC);

    echo json_encode(['success' => true, 'ads' => $ads]);
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Error fetching ads: ' . $e->getMessage()]);
}

$conn->close();
?>
