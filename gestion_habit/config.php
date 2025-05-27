<?php
$servername = "localhost";
$username = "root";
$password = "92603360";
$dbname = "ma_boutique";

// Créer une connexion à la base de données
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("La connexion à la base de données a échoué : " . $conn->connect_error);
}
?>

