
<?php
$user = 'root';
$pass = '';
try {
    $db = new PDO('mysql:host=localhost;dbname=greengarden', $user, $pass);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $login = $_POST['login'];
        $password = $_POST['password'];

        $query = "SELECT * FROM t_d_user WHERE Login = :login";
        $statement = $db->prepare($query);
        $statement->bindParam(':login', $login);
        $statement->execute();
        $user = $statement->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['Password'])) {
            echo "Connexion réussie pour l'utilisateur : " . $user['Login'];
            // Redirection vers une page sécurisée ou autre traitement après connexion réussie
        } else {
            echo "Identifiants incorrects";
        }
    }
} catch (PDOException $e) {
    echo "Erreur :" . $e->getMessage();
    die;
}


// Traitement du formulaire d'inscription
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupération des données du formulaire
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $mail = $_POST['mail'];
    $tel = $_POST['tel'];

    try {
        // Préparation de la requête d'insertion
        $query = $db->prepare('INSERT INTO t_d_client (Nom_Client, Prenom_Client, Mail_Client, Tel_Client) VALUES (:nom, :prenom, :mail, :tel)');
        // Liaison des paramètres
        $query->bindParam(':nom', $nom);
        $query->bindParam(':prenom', $prenom);
        $query->bindParam(':mail', $mail);
        $query->bindParam(':tel', $tel);
        // Exécution de la requête
        $query->execute();

        echo "Inscription réussie !";
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
    <title>Connexion</title>
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

    <h2>Connexion</h2>
    <form action="acceuilProduit.php" method="post">
        <label for="login">Pseudonyme :</label><br>
        <input type="text" id="login" name="login"><br>
        <label for="password">Mot de passe :</label><br>
        <input type="password" id="password" name="password"><br><br>
        <input type="submit" value="Se connecter">
    </form> <br>
    <h2>Inscription</h2>
    <form action="inscription.php" method="post">
        <label for="nom">Nom :</label><br>
        <input type="text" id="nom" name="nom"><br><br>
        
        <label for="prenom">Prénom :</label><br>
        <input type="text" id="prenom" name="prenom"><br><br>
        
        <label for="mail">Mail :</label><br>
        <input type="email" id="mail" name="mail"><br><br>
        
        <label for="tel">Tél :</label><br>
        <input type="text" id="tel" name="tel"><br><br>
        
        <input type="submit" value="S'inscrire">
    </form>
    <form name="footer">
    <footer>Copyright © 2023 Nadya HADDAJI</footer>
    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
