<?php
session_start();
include("config.php");
include("header.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom'];
    $prix = $_POST['prix'];
    $quantite = $_POST['quantite'];
    $description = $_POST['description'];
    $image = $_FILES['image'];
    $imageTempPath = $image['tmp_name'];
    $imagePath =  'images-h/' . $image['name'];
    move_uploaded_file($image['tmp_name'], $imagePath);



    
    $sql = "INSERT INTO habits (nom, prix, quantite,  description) VALUES ('$nom', '$prix', '$quantite', '$imagePath', '$description')";

    if ($conn->query($sql) === TRUE) {
        echo "<p>Le produit a été ajouté avec succès.</p>";
    } else {
        echo "Erreur lors de l'ajout du produit : " . $conn->error;
    }
    header("Location: \ecommerce\index.php?image=" . urlencode($imagePath));
    exit;
}
?>

<h1>Ajouter un produit</h1>

<form method="post" action="" enctype="multipart/form-data">
    <label for="nom">Nom :</label>
    <input type="text" name="nom" required><br>
    <label for="image">image :</label>
    <input type="file" name="image" required><br>
    <label for="prix">Prix :</label>
    <input type="number" name="prix" step="0.01" required><br>
    <label for="description">description :</label>
    <input type="text" name="description" step="0.01" required><br>

    <label for="quantite">Quantité :</label>
    <input type="number" name="quantite" required><br>

    <input type="submit" value="Ajouter">
</form>

<a href="index.php">Retour à la page d'accueil</a>

<?php include("footer.php"); ?>
