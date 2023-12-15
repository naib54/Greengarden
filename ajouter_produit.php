<?php
$user = 'root';
$pass = '';

try {
    $db = new PDO('mysql:host=localhost;dbname=greengarden', $user, $pass);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Erreur :" . $e->getMessage();
    die;
}

// Ajouter un produit
if (isset($_POST['ajouter_produit'])) {
    $tauxTVA = $_POST['taux_tva'];
    $nomLong = $_POST['nom_long'];
    $nomCourt = $_POST['nom_court'];
    $refFournisseur= $_POST['ref_fournisseur'];
    $photo= $_POST['photo'];
    $idFournisseur = $_POST['id_fournisseur']; // Récupération de l'Id_Fournisseur
    $idCategorie = $_POST['id_categorie'];

    $sql = "INSERT INTO t_d_produit (Taux_TVA, Nom_Long, Nom_court, Ref_fournisseur, photo, Id_Fournisseur, Id_Categorie) VALUES (:tauxTVA, :nomLong, :nomCourt, :refFournisseur, :photo, :idFournisseur, :idCategorie)";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':tauxTVA', $tauxTVA);
    $stmt->bindParam(':nomLong', $nomLong);
    $stmt->bindParam(':nomCourt', $nomCourt);
    $stmt->bindParam(':refFournisseur', $refFournisseur); // Correction du nom du paramètre
    $stmt->bindParam(':photo', $photo);
    $stmt->bindParam(':idFournisseur', $idFournisseur); // Liaison du paramètre pour l'Id_Fournisseur
    $stmt->bindParam(':idCategorie', $idCategorie);
    
    if ($stmt->execute()) {
        echo "Le produit a été ajouté avec succès.";
    } else {
        echo "Erreur lors de l'ajout du produit.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Gestion des produits</title>
    <link href="../css/style.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<nav class="navbar bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand">GreenGarden</a> 
    <h5> Bonjour découvrez nos produits</h5>
    <form class="d-flex" action="categories.php" method="GET"> 
      <button class="btn btn-outline-success" type="submit">Catégorie des produits</button>
    </form>
    <form class="d-flex" action="Connexion.php" method="GET" role="connection"> 
      <button class="btn btn-outline-success" type="submit">Se connecter</button>
    </form>
  </div>
</nav>
<body>

<h2>Ajouter un produit</h2>
<form method="post" action="ajouter_produit.php">
    <label for="nom_long">Nom long :</label>
    <input type="text" id="nom_long" name="nom_long" required><br><br>

    <label for="nom_court">Nom court :</label>
    <input type="text" id="nom_court" name="nom_court" required><br><br>

    <label for="ref_fournisseur">Référence fournisseur :</label>
    <input type="text" id="ref_fournisseur" name="ref_fournisseur" required><br><br>

    <label for="photo">URL de la photo :</label>
    <input type="text" id="photo" name="photo"><br><br>

    <label for="prix_achat">Prix d'achat :</label>
    <input type="text" id="prix_achat" name="prix_achat" required><br><br>

    <label for="taux_tva">Taux de TVA :</label>
    <input type="text" id="taux_tva" name="taux_tva" required><br><br>

    <label for="id_fournisseur">ID du fournisseur :</label>
    <input type="text" id="id_fournisseur" name="id_fournisseur" required><br><br>

    <label for="id_categorie">ID de la catégorie :</label>
    <input type="text" id="id_categorie" name="id_categorie" required><br><br>

    <input type="submit" name="ajouter_produit" value="Ajouter">
</form>
<form name="footer">
    <footer>Copyright © 2023 Nadya HADDAJI</footer>
    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
