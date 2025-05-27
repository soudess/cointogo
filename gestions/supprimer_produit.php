<?php
session_start();
include("config.php");
include("header.php");

$id = $_GET['id'];

// Supprimer le produit de la base de données
$sql = "DELETE FROM produits WHERE id = '$id'";

if ($conn->query($sql) === TRUE) {
    echo "<p>Le produit a été supprimé avec succès.</p>";
} else {
    echo "Erreur lors de la suppression du produit : " . $conn->error;
}
?>

<a href="index.php"> <button class="btn btn-primary">Retour à la page d'accueil</button></a>

<?php include("footer.php"); ?>
