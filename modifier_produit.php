<?php
// Connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "greengarden";

$conn = new mysqli($servername, $username, $password, $dbname);

// Vérification de la connexion
if ($conn->connect_error) {
    die("La connexion a échoué : " . $conn->connect_error);
}

// Récupération des produits depuis la base de données
$sql = "SELECT * FROM t_d_produit";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des produits</title>
    <link href="../css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/stylemodifier.css">
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
    <h1>Liste des produits</h1>
    
    <table class="t1">
        <tr>
            <th>Nom Long</th>
            <th>Nom Court</th>
            <th>Référence Fournisseur</th>
            <th>Photo</th>
            <th>Prix d'achat</th>
            <th>Taux de TVA</th>
            <th>ID Fournisseur</th>
            <th>ID Catégorie</th>
            <th>Actions</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['Nom_Long'] . "</td>";
                echo "<td>" . $row['Nom_court'] . "</td>";
                echo "<td>" . $row['Ref_fournisseur'] . "</td>";
                echo "<td>" . $row['Photo'] . "</td>";
                echo "<td>" . $row['Prix_Achat'] . "</td>";
                echo "<td>" . $row['Taux_TVA'] . "</td>";
                echo "<td>" . $row['Id_Fournisseur'] . "</td>";
                echo "<td>" . $row['Id_Categorie'] . "</td>";
                echo "<td>
                        <a href='modifier_produit.php?id=" . $row['Id_Produit'] . "'>Modifier</a> | 
                       
                      </td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='9'>Aucun produit trouvé.</td></tr>";
        }
        ?>
    </table>
   
    <form name="footer">
    <footer>Copyright © 2023 Nadya HADDAJI</footer>
    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
