<?php
  ini_set('display_errors','on');
  error_reporting(E_ALL);

  header("Access-Control-Allow-Origin: *");
  header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
  header("Access-Control-Allow-Headers: Content-Type, Authorization");

  // Connexion informations
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "jungpal";

  // Connexion creation
  $conn = new mysqli($servername, $username, $password, $dbname);

  // Verification of connexion
  if ($conn->connect_error) {
      die("La connexion a échoué : " . $conn->connect_error);
  }

?>