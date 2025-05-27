
 <?php
session_start();
include("config.php");
include("header.php");

$id = $_GET['id'];

// Rechercher le produit dans la base de données
$sql = "SELECT * FROM asseccoire WHERE id = '$id'";
$result = $conn->query($sql);
$produit = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom'];
    $prix = $_POST['prix'];
    $quantite = $_POST['quantite'];
    $description = $_POST['description'];

    // Mettre à jour le produit dans la base de données
    $sql = "UPDATE produits SET nom='$nom', prix='$prix', quantite='$quantite', description='$description' WHERE id='$id'";

    if ($conn->query($sql) === TRUE) {
        echo "<p>Le produit a été modifié avec succès.</p>";
    } else {
        echo "Erreur lors de la modification du produit : " . $conn->error;
    }
}
?>

<h1>Modifier un produit</h1>

<?php if ($produit) : ?>
    <form method="post">
        <label for="nom">Nom :</label>
        <input type="text" name="nom" value="<?php echo $produit['nom']; ?>" required><br>

        <label for="prix">Prix :</label>
        <input type="number" name="prix" step="0.01" value="<?php echo $produit['prix']; ?>" required><br>
        <label for="description">description :</label>
        <input type="text" name="description" step="0.01" value="<?php echo $produit['description']; ?>" required><br>

        <label for="quantite">Quantité :</label>
        <input type="number" name="quantite" value="<?php echo $produit['quantite']; ?>" required><br>

        <input type="submit" value="Modifier">
    </form>
<?php else : ?>
    <p>Produit non trouvé.</p>
<?php endif; ?>

<a href="index.php">Retour à la page d'accueil</a>

<?php include("footer.php"); ?>
