<?php
session_start();
$database = "agora";

$db_handle = mysqli_connect('localhost', 'root', ''); //ENLEVER ROOT EN MDP
$db_found = mysqli_select_db($db_handle, $database);

$subtotal = 0;

if ($db_found) {
    $user_id = $_SESSION['user_id']; //RÉCUPÉRER L'UTILISATEUR CONNECTÉ
    $sql = "SELECT objet.Photo, objet.Nom, objet.Description, objet.Type, objet.prix
            FROM panier
            JOIN objet ON panier.ID_objet = objet.ID_objet"
            /*WHERE panier.user_id = '$user_id'";*/
			//type de vente : modifier nom dans bdd
    $cart_result = mysqli_query($db_handle, $sql);
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Panier</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="wrapper">
        <div>
            <h1 class="logo" align="center"><a href="index.html"><img src="./Images/logo-agora.png" height="140px"></a></h1>
        </div>
        <br>
        <ul class="dropdownmenu">
            <li><a href="../projet/Accueil.php">ACCUEIL</a></li>
            <li><a href="#" style="text-decoration:none">TOUT PARCOURIR</a>
                <ul>
                    <li><a href="achat-immediat.php">Achat immédiat</a></li>
                    <li><a href="transaction-vendeur-acheteur.php">Transaction vendeur/client</a></li>
                    <li><a href="meilleure-offre.php">Meilleure offre</a></li>
                </ul>
            </li>
            <li><a href="notifications.php">NOTIFICATION</a></li>
            <li><a href="panier.php">PANIER</a></li>
            <li><a href="Connexion/Compte.php">COMPTE</a></li>
        </ul>
        <div class="content">
            <h1>Votre panier</h1>
            <?php
            if ($cart_result && mysqli_num_rows($cart_result) > 0) {
                while($product = mysqli_fetch_assoc($cart_result)) {
                    $photo = $product['Photo'];
                    $nom = $product['Nom'];
                    $description = $product['Description'];
                    $type_achat = $product['Type'];
                    $prix = $product['Prix'];
                    $subtotal += $prix;

                    echo "<div>";
                    echo "<img src='$photo' alt='Photo de l'article' width='100'><br>";
                    echo "<strong>$nom</strong><br>";
                    echo $description . "<br>";
                    echo "Type d'achat : $type_achat<br>";
                    echo "Prix : " . $prix . " €<br>";
                    echo "</div><hr>";
                }
            } else {
                echo "<p>Votre panier est vide.</p>";
            }
            ?>
            <h2>Sous-total : <?php echo $subtotal; ?> €</h2>
            <form action="paiement.php" method="post">
                <input type="submit" value="Commander">
            </form>
        </div>
        <footer>
            <p>&copy; 2024 - Agora Francia - Tous droits réservés - <a href="mentions-legales.html">Mentions légales</a></p>
            <p>Développement et design par l'équipe 104</p>
        </footer>
    </div>
</body>
</html>
