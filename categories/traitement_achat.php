<?php
// Assurez-vous d'avoir configuré votre connexion à la base de données ici
$db_host ="localhost";
$db_user = "root";
$db_password = "";
$db_name = "ma_boutique";

$conn = mysqli_connect($db_host, $db_user, $db_password, $db_name);

if (!$conn) {
  die("Échec de la connexion à la base de données: " . mysqli_connect_error());
}
  $nom = $_POST['nom'];
  $email = $_POST['email'];
  $taille = $_POST['taille'];
  $pays = $_POST['pays'];
  $ville2 = $_POST['ville2'];
  $couleur = $_POST['couleur'];
  $quantite = $_POST['quantite'];
  
  
  $ville1 = 'ceg Kossigan';
  // Appel à l'API Distance Matrix de Google Maps
  $url = "https://maps.googleapis.com/maps/api/distancematrix/json?units=metric&origins=" . urlencode($ville1) . "&destinations=" . urlencode($ville2) . "&key=VOTRE_CLE_API";
  $response = file_get_contents($url);
  $data = json_decode($response, true);

  // Récupérer la distance
  $distance = $data['rows'][0]['elements'][0]['distance']['text'];

  // Afficher la distance


  // Insérer les données dans la base de données
  $query = "INSERT INTO commands (nom, email, taille, pays, ville2, couleur, quantite, distance) VALUES ('$nom', '$email', '$taille', 'pays', 'ville2', '$couleur', '$quantite', 'distance')";
  mysqli_query($conn, $query);

  // Rediriger vers une page de confirmation
  
  exit;


mysqli_close($conn);
?>
