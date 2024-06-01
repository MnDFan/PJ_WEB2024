<?php
session_start();
$database = "agora";

$db_handle = mysqli_connect('localhost', 'root', ''); //ENLEVER ROOT EN MDP
$db_found = mysqli_select_db($db_handle, $database);

$subtotal = 0;

if ($db_found) {
    if (isset($_SESSION['LOGGED_USER'])){
    $user_id = $_SESSION['ID_ACHETEUR']; //RÉCUPÉRER L'UTILISATEUR CONNECTÉ
    $sql = "SELECT panier.NumPanier,objet.ID_objet, objet.Photo, objet.Nom, objet.Description, objet.Type, objet.Prix
            FROM panier
            JOIN objet ON panier.ID_objet = objet.ID_objet";
            /*WHERE panier.user_id = '$user_id'";*/
			//type de vente : modifier nom dans bdd
    $cart_result = mysqli_query($db_handle, $sql);
}
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
            <li><a href="accueil.php">ACCUEIL</a></li>
            <li><a href="#" style="text-decoration:none">TOUT PARCOURIR</a>
                <ul>
                    <li><a href="achat_immediat/achat_immediat.php">Achat immédiat</a></li>
                    <li><a href="transaction-vendeur-acheteur.php">Transaction vendeur/client</a></li>
                    <li><a href="meilleure_offre/meilleure_offre.php">Meilleure offre</a></li>
                </ul>
            </li>
            <li><a href="notifications.php">NOTIFICATION</a></li>
            <li><a href="panier.php">PANIER</a></li>
            <li><a href="compte.php">COMPTE</a></li>
        </ul>
        <div class="content">
            <h1>Votre panier</h1>
            <div class="form-container">
            <?php if (isset($_SESSION['LOGGED_USER'])) : ?>
            <form action="article/supprimer_article.php" method="post">
            <?php
            if ($cart_result && mysqli_num_rows($cart_result) > 0) {

                while($product = mysqli_fetch_assoc($cart_result)) {
                    $id_objet = $product['NumPanier'];
                    $photo = $product['Photo'];
                    $nom = $product['Nom'];
                    $description = $product['Description'];
                    $type_achat = $product['Type'];
                    $prix = $product['Prix'];
                    $prix=(int)$prix;
                    $subtotal += $prix;

                    echo "<div>";
                    echo "<img src='$photo' alt='Photo de l'article' width='100'><br>";
                    echo "<strong>$nom</strong><br>";
                    echo $description . "<br>";
                    echo "Type d'achat : $type_achat<br>";
                    echo "Prix : " . $prix . " €<br>";?>
                    <button type="submit" name="supprimer" value="<?php echo $id_objet ?>">Supprimer article</button>
                    <?php echo "</div><hr>";
                    
                    

                }
            } else {
                echo "<p>Votre panier est vide.</p>";
            }
            ?>
        </form>
            <h2>Sous-total : <?php echo $subtotal; ?> €</h2>
            <form action="paiement.php" method="post">
                <input type="submit" value="Commander">
            </form>
            <?php else :?>
                        <a href="compte.php"><button>Se connecter</button></a>
                <?php endif ?>
                </div>
        </div>
        <footer>
            <p>&copy; 2024 - Agora Francia - Tous droits réservés - <a href="mentions-legales.html">Mentions légales</a></p>
            <p>Développement et design par l'équipe 104</p>
        </footer>
    </div>
</body>
</html>
