<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include("bdd.php");

$maxPrice = isset($_GET['maxPrice']) ? (int)$_GET['maxPrice'] : null;

//get all the ads under a certain price
$query = "SELECT id, rooms, price, size, deposit, internet, campus_time, party, garden, cleaning FROM ads";

if ($maxPrice !== null) {
    $query = "SELECT id, rooms, price, size, deposit, internet, campus_time, party, garden, cleaning FROM ads WHERE price <= ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $maxPrice);
} else {
    $stmt = $conn->prepare($query);
}

$stmt->execute();
$result = $stmt->get_result();

$ads = [];
while ($row = $result->fetch_assoc()) {
    $ads[] = $row;
}

header('Content-Type: application/json');
echo json_encode([
    'success' => true,
    'ads' => $ads
]);

$stmt->close();
$conn->close();
?>
