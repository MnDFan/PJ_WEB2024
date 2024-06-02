<?php
session_start();
$_SESSION['REMPLIR'] = '';
$database = "agora";

$db_handle = mysqli_connect('localhost', 'root', ''); //ENLEVER ROOT EN MDP
$db_found = mysqli_select_db($db_handle, $database);

$subtotal = 0;

if ($db_found) {
    if($_SESSION['ID_VENDEUR'] != ''){
    $user_id = $_SESSION['ID_VENDEUR']; //RÉCUPÉRER L'UTILISATEUR CONNECTÉ
    $sql = "SELECT objet.ID_objet, objet.Photo, objet.Nom, objet.Description, objet.Type, objet.Prix
            FROM vendeur
            JOIN objet ON vendeur.ID_vendeur = objet.IDvendeur";
    $cart_result = mysqli_query($db_handle, $sql);
} else {
    $user_id = $_SESSION['ID_ADMIN']; //RÉCUPÉRER L'UTILISATEUR CONNECTÉ
}
    $sql = "SELECT objet.ID_objet, objet.Photo, objet.Nom, objet.Description, objet.Type, objet.Prix
            FROM administrateur
            JOIN objet ON administrateur.ID_admin = objet.IDadmin";
    $cart_result = mysqli_query($db_handle, $sql);
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Panier</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <div class="wrapper">
        <div>
            <h1 class="logo" align="center"><a href="index.html"><img src="../Images/logo-agora.png" height="140px"></a></h1>
        </div>
        <br>
        <ul class="dropdownmenu">
            <li><a href="../accueil.php">ACCUEIL</a></li>
            <li><a href="#" style="text-decoration:none">TOUT PARCOURIR</a>
                <ul>
                    <li><a href="../achat_immediat/achat_immediat.php">Achat immédiat</a></li>
                    <li><a href="../transaction-vendeur-acheteur.php">Transaction vendeur/client</a></li>
                    <li><a href="../meilleure_offre/meilleure_offre.php">Meilleure offre</a></li>
                </ul>
            </li>
            <li><a href="../notifications.php">NOTIFICATION</a></li>
            <li><a href="../panier.php">PANIER</a></li>
            <li><a href="../compte.php">COMPTE</a></li>
        </ul>
        <div class="content">
            <h1>Liste produits</h1>
            <div class="form-container">
            <form action="supprimer_bdd_objet.php" method="post">
            <?php
            if ($cart_result && mysqli_num_rows($cart_result) > 0) {

                while($product = mysqli_fetch_assoc($cart_result)) {
                    $id_objet = $product['ID_objet'];
                    $photo = $product['Photo'];
                    $nom = $product['Nom'];
                    $description = $product['Description'];
                    $type_achat = $product['Type'];
                    $prix = $product['Prix'];
                    $prix=(int)$prix;
                    $subtotal += $prix;

                    echo "<div>";
                    echo "<img src='../$photo' alt='Photo de l'article' width='100'><br>";
                    echo "<strong>$nom</strong><br>";
                    echo $description . "<br>";
                    echo "Type d'achat : $type_achat<br>";
                    echo "Prix : " . $prix . " €<br>";?>
                    <button type="submit" name="supprimer"  value="<?php echo $id_objet ?>">Supprimer article</button>
                    <?php echo "</div><hr>";
                    
                    

                }
            } else {
                echo "<p>Vous n'avez aucun produit.</p>";
            }
            ?>
        </form>
                </div>
        </div>
        <br>
        <p><button class="DarkMode" onclick="DarkMode()">assombrir</button></p>
        <script>
             function DarkMode() {
                var element = document.body;
                element.classList.toggle("dark-mode");
              }   
        </script>
        <footer>
            <p>&copy; 2024 - Agora Francia - Tous droits réservés - <a href="mentions-legales.html">Mentions légales</a></p>
            <p>Développement et design par l'équipe 104</p>
        </footer>
    </div>
</body>
</html>