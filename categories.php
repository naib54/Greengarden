<?php
$user = 'root';
$pass = '';

// Connexion à la base de données
try {
    $db = new PDO('mysql:host=localhost;dbname=greengarden', $user, $pass);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Erreur :" . $e->getMessage();
    die;
}

// Récupération des catégories depuis la base de données
try {
    $categories = $db->query('SELECT * FROM t_d_categorie')->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Erreur :" . $e->getMessage();
    die;
}

// Traitement du formulaire de recherche par catégorie
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['categorie'])) {
    $categorieSelectionnee = $_POST['categorie'];
    try {
        // Récupération des produits associés à la catégorie sélectionnée
        $resultats = $db->prepare('SELECT p.* FROM t_d_produit p JOIN t_d_categorie c ON p.Id_Categorie = c.Id_Categorie WHERE c.Libelle = :libelle');
        $resultats->bindParam(':libelle', $categorieSelectionnee);
        $resultats->execute();
        $produits = $resultats->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Erreur :" . $e->getMessage();
        die;
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recherche par catégorie</title>
    <link href="../css/style.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<nav class="navbar bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand">GreenGarden</a> 
    <h5> Bonjour découvrez nos produits</h5>
    <form class="d-flex" action="Connexion.php" method="GET" role="connection"> 
      <button class="btn btn-outline-success" type="submit">Se connecter</button>
    </form>
 
  </div>
</nav>
<body>

    <h2>CATEGORIE DES PRODUITS</h2>
    <form action="" method="post">
        <label for="categorie">Choisir une catégorie :</label><br>
        <select id="categorie" name="categorie">
            <?php foreach ($categories as $categorie) { ?>
                <option value="<?php echo $categorie['Libelle']; ?>">
                    <?php echo $categorie['Libelle']; ?>
                </option>
            <?php } ?>
        </select><br><br>
        <input type="submit" value="Rechercher">
    </form>

    <?php if (isset($produits)) { ?>
    <h3>Résultats de la recherche</h3>
    <div class="card-group">
        <?php foreach ($produits as $produit) { ?>
            <div class="card" style="width: 18rem;">
                <img src="<?php echo $produit['Photo']; ?>" class="card-img-top" alt="Product Image">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $produit['Nom_court']; ?></h5>
                    <!-- Vous pouvez ajouter d'autres détails du produit ici -->
                    <p class="card-text"><?php echo $produit['Nom_Long']; ?>.</p>
                </div>
            </div>
        <?php } ?>
    </div>
<?php } ?>





<form name="footer">
    <footer>Copyright © 2023 Nadya HADDAJI</footer>
    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
