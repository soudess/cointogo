<?php
session_start();
include("config.php");
include("header.php");

$id = $_GET['id'];

// Récupérer les détails du produit depuis la base de données
$sql = "SELECT * FROM habits WHERE id = '$id'";
$result = $conn->query($sql);
$produit = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $quantiteVendue = $_POST['quantite_vendue'];

    // Vérifier si la quantité vendue est valide
    if ($quantiteVendue <= 0 || $quantiteVendue > $produit['quantite']) {
        echo "<p>La quantité vendue n'est pas valide.</p>";
    } else {
        // Mettre à jour la quantité du produit dans la base de données
        $nouvelleQuantite = $produit['quantite'] - $quantiteVendue;
        $sql = "UPDATE produits SET quantite = '$nouvelleQuantite' WHERE id = '$id'";

        if ($conn->query($sql) === TRUE) {
            // Enregistrer la vente dans la table 'ventes'
            $sql = "INSERT INTO ventes (produit_id, quantite,) VALUES ('$id', '$quantiteVendue')";
            $conn->query($sql);

            echo "<p>Vente effectuée avec succès.</p>";
            // Rediriger vers la page d'accueil après la vente
            header("Location: index.php");
            exit();
        } else {
            echo "Erreur lors de la vente du produit : " . $conn->error;
        }
    }
}
?>
<div class="d-flex justify-content-between align-items-center">


<h1>Vendre un produit</h1>

<?php if ($produit) : ?>

    <h2>Produit : <?php echo $produit['nom']; ?></h2>
    <p>Prix : <?php echo $produit['prix']; ?></p>
    <p>Quantité disponible : <?php echo $produit['quantite']; ?></p>
    </div>
    <form method="post" class="vstack gap-1 p-5">
        <div class="row">
            <label for="quantite_vendue">Quantité à vendre :</label>
        <input type="number" name="quantite_vendue" min="1" max="<?php echo $produit['quantite']; ?>" required><br>
        </div>
        

       
        <button type="submit" class="btn btn-primary">Vendre</button>
    </form>
<?php else : ?>
    <p>Produit non trouvé.</p>
<?php endif; ?>

<a href="boutique.php"><button class="btn btn-primary">Retour à la page d'accueil</button>  </a>

<?php include("footer.php"); ?>
