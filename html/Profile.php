<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="../css/Profile.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Lexend Mega' rel='stylesheet'>
    <title>Your profile</title>
    <link rel="icon" href="../Images/Logo.jpeg" type="image/x-icon">
</head>
<body>

<header>
    <nav>
        <a href="homepage_connected.html"><img id="image" src="../Images/Logo.jpeg" alt="Elderly Companions Logo"></a>
        <h1>Elderly Companions</h1>
        <a href="homepage_connected.html"><div id="home">Home</div></a>
    </nav>
</header>

<?php
session_start();
$user_id = $_SESSION['user_id'];
include("../php/bdd.php");
$stmt = $conn->prepare("SELECT id FROM ads WHERE ads.user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$ad = $result->fetch_assoc();

?>

<form id="profileForm" action="../php/submit.php" method="post">
    <input type="hidden" id="adId" name="ad_id" value="">
    <input type="hidden" id="userId" name="user_id" value="<?php echo $user_id; ?>">
    <div id="grid">
        <div id="rectangle_name">
            <div id="Container_profil">
                <div id="imageContainer"></div>
                <div id="name"></div>
                <div id="surname"></div>
                <input type="file" id="button" name="photo" accept="image/*" onchange="ajouterPhoto('button', 'imageContainer')">
            </div>
            <div class="ligne-verticale"></div>
            <div class="button-container">
                <a href="information.html"><button class="button" type="button">Changing personal information</button></a>
                <button class="button" type="button">See your contract</button>
                <button class="button" type="button">Your mailbox</button>
                <button class="button" type="button">Report a problem</button>
            </div>
        </div>

        <div id="rental_condition">
            <h2>Rental conditions</h2>
            <div id="Party">Party: <input type="text" id="part" name="party" placeholder="Yes / No"></div>
            <div id="Garden">Garden help: <input type="text" id="gard" name="garden" placeholder="Yes / No"></div>
            <div id="Cleaning">Cleaning: <input type="text" id="clean" name="cleaning" placeholder="Yes / No"></div>
        </div>

        <div id="house_rectangle">
            <h3>Your house</h3>
            <div id="House_picture"></div>
            <input type="file" id="button2" name="house-photo" accept="image/*" onchange="ajouterPhoto('button2', 'House_picture')">
            <div id="container_house">
                <div id="numbers_rooms">Number of rooms: <input class="block" type="text" id="rooms" name="rooms" placeholder="Number of rooms"></div><br>
                <div id="price_rooms">Price: <input class="block" type="text" id="price" name="price" placeholder="Price"></div><br>
                <div id="area">Area: <input class="block" type="text" id="size" name="size" placeholder="Size of the room"></div><br>
                <div id="Internet">Internet: <input class="block" type="text" id="connexion" name="internet" placeholder="Yes / No"></div><br>
                <div id="Deposit">Deposit: <input class="block" type="text" id="dep" name="deposit" placeholder="Price of the deposit"></div><br>
                <div id="Campus">Campus time: <input class="block" type="text" id="Camp" name="campus-time" placeholder="Number of minutes"></div>
            </div>
        </div>

        <div id="announce">
            <h4>Your ad</h4>
            <div id="button_ad_container">
                <a href="add.html?id=<?php echo $ad['id']; ?>"><button class="button_ad" type="button">See your ad</button></a>
                <button class="button_ad" type="button" id="unlock">Edit ad information</button>
                <button class="button_ad" type="button" id="submitAd">Create ad</button>
                <button class="button_ad" type="button" id="deleteAd">Delete your ad</button>
            </div>
        </div>
    </div>
</form>

<script src="../js/Photo.js"></script>
<script src="../js/profile.js"></script>
<script src="../js/ad.js"></script>
<script src="../js/delete_ad.js"></script>
<script src="../js/update_ad.js"></script>
</body>
</html>