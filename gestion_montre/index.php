<?php
session_start();
include("config.php");
include("header.php");

// Récupérer la liste des produits depuis la base de données
$sql = "SELECT * FROM montre";
$result = $conn->query($sql);
$produits = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $produits[] = $row;
    }
}

?>




<?php if (count($produits) > 0) : ?>
    <div class="d-flex justify-content-between align-items-center">
             <h1>Gestion de Boutique</h1>
            <a href="\ecommerce\index.php"><button class="btn btn-primary">Ma boutique</button></a>
            <a href="ajouter_produit.php"><button class="btn btn-primary">Ajouter un produit</button></a>
</div>
   
    <table class="table table-striped">
        <tr>
            <th>ID</th>
            <th>image</th>
            <th>Nom</th>
            <th>Prix</th>
            
            <th>Quantité</th>
            <th>prix total </th>
            <th class="text-end">Actions</th>
        </tr>
        <?php foreach ($produits as $produit) : ?>
            <tr>
                <td><?php echo $produit['id']; ?></td>
                <td><img src="<?php echo $produit['image']; ?>" width="70" height="40" alt=""></td>
                <td><?php echo $produit['nom']; ?></td>
                <td><?php echo $produit['prix']; ?></td>
                
                <td><?php echo $produit['quantite']; ?></td>
                <td><?php echo $produit['prix'] * $produit['quantite']; ?></td>
                <td class="text-end">
                    
                <a href="vendre_produit.php?id=<?php echo $produit['id']; ?>"> <button class="btn btn-dark">Vendre un produit</button></a>
                    <a  href="modifier_produit.php?id=<?php echo $produit['id']; ?>"><button class="btn btn-primary">Modifier</button></a>
                    <a  href="supprimer_produit.php?id=<?php echo $produit['id']; ?>"><button class="btn btn-danger">Supprimer</button></a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php else : ?>
    <p>Aucun produit trouvé.</p>
<?php endif; ?>

<a href="historique_ventes.php?id=<?php echo $produit['id']; ?>">voir Historique des ventes</a>

<?php include("footer.php"); ?>
