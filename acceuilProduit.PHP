<?php
$user = 'root';
$pass = '';
try {
    $db = new PDO('mysql:host=localhost;dbname=greengarden', $user, $pass);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $resultats = $db->query('SELECT Photo, Prix_Achat, Nom_Long, Nom_court FROM t_d_produit')->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Erreur :" . $e->getMessage();
    die;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des produits</title>
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
    <div class="container">
        <h3>Nos produits</h3>
        <div class="row">
            <?php foreach ($resultats as $row) { ?>
                <div class="col-md-4 mb-3">
                    <div class="card" style="width: 18rem;">
                        <h4 class="card-title"><?php echo $row['Nom_court']; ?></h4>
                        <img src="<?php echo $row['Photo']; ?>" class="card-img-top" alt="Product Image">
                        <div class="card-body">
                            <h6 class="card-title"><?php echo $row['Nom_Long']; ?><h6>
                            <p class="card-text"><?php echo 'Prix: ' . $row['Prix_Achat']; ?></p>
                            <button class="btn btn-primary" onclick="addToCart('<?php echo $row['Nom_court']; ?>', <?php echo $row['Prix_Achat']; ?>)">Ajouter au panier</button>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
        <!-- Panier -->
        <h3>Panier</h3>
        <ul id="cart"></ul>
        <p id="totalPrice">Total: $0</p>
    </div>
    <script>
        let cart = []; // Panier vide

        // Fonction pour ajouter un produit au panier
        function addToCart(productName, price) {
            cart.push({ name: productName, price: price }); // Ajoute le produit au panier
            displayCart(); // Affiche le panier mis à jour
        }

        // Fonction pour afficher le contenu du panier
        function displayCart() {
            let cartList = document.getElementById('cart');
            let totalPrice = document.getElementById('totalPrice');
            cartList.innerHTML = ''; // Efface le contenu actuel du panier
            let total = 0;

            cart.forEach(product => {
                let listItem = document.createElement('li');
                listItem.textContent = `${product.name} - Prix: ${product.price}$`;
                cartList.appendChild(listItem); // Ajoute chaque produit au panier affiché
                total += product.price; // Calcule le total des prix
            });

            totalPrice.textContent = `Total: $${total}`; // Affiche le total
        }
    </script>
      <form name="footer">
    <footer>Copyright © 2023 Nadya HADDAJI</footer>
    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
