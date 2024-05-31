<?php
session_start();
// Connexion à la base de données
$database = "agora";
//connectez-vous dans votre BDD
//Rappel : votre serveur = localhost: | votre login = root | votre mot de pass = '' (rien)
$db_handle = mysqli_connect('localhost', 'root', '');
$db_found = mysqli_select_db($db_handle, $database);
 //si le BDD existe, faire le traitement

// Vérifiez la connexion
if ($db_found) {
   
// Récupérer id de l'article
if($_SESSION['ID'] == -1){
    $id = $_GET['id'];
    $_SESSION['ID'] = $id;
} else {
    $id = $_SESSION['ID'];
    $id = (int)$id;
}
    



//Preparer et exécuter la requête

$sql = "SELECT * FROM objet WHERE ID_objet = '$id'";
$result = mysqli_query($db_handle, $sql);

// Vérifier si l'article existe
if ($result->num_rows > 0) {
    $article = $result->fetch_assoc();
} else {
    echo "Article non trouvé ." . $id;
    exit;
}
}

else {
 echo "Database not found";
}//end else
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Agora Francia</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .article-container {
            max-width: 600px;
            margin: 0 auto;
            text-align: center;
            border: 1px solid #ddd;
            padding: 20px;
            border-radius: 10px;
        }
        img {
            max-width: 100%;
            height: auto;
        }
        .price {
            color: #b12704;
            font-size: 1.5em;
            margin: 10px 0;
        }
        .vendor, .category, .description {
            margin: 10px 0;
        }
        .buttons {
            margin-top: 20px;
        }
        .buttons button {
            padding: 10px 20px;
            margin: 5px;
            font-size: 1em;
            cursor: pointer;
        }
    </style>
     <script>
        function ajouterAuPanier(id) {
            // Fonction JavaScript pour ajouter au panier
            alert("Article " + id + " ajouté au panier!");
        }

        function payerEnUnClic(id) {
            // Fonction JavaScript pour payer en un clic
            alert("Paiement en 1 clic pour l'article " + id + "!");
        }
    </script>
</head>
<body>
    <div class="wrapper">
        <div>
            <h1 class="logo" align="center"><a href="index.html"><img src="./Images/logo-agora.png" height="140px"></a></h1>
        </div>
        <br>
        <ul class="dropdownmenu">
            <li><a href="Accueil.html">ACCUEIL</a></li>
            <li><a href="#" style="text-decoration:none">TOUT PARCOURIR</a>
                <ul>
                    <li><a href="achat-immediat.php">Achat immédiat</a></li>
                    <li><a href="transaction-vendeur-acheteur.html">Transaction vendeur/client</a></li>
                    <li><a href="meilleure-offre.html">Meilleure offre</a></li>
                </ul>
            </li>
            <li><a href="notifications.html">NOTIFICATION</a></li>
            <li><a href="panier.html">PANIER</a></li>
            <li><a href="Compte.php">COMPTE</a></li>
        </ul>
        <div class="content">
            <div class="article-container">
        <h1><?php echo htmlspecialchars($article['Description']); ?></h1>
        <img src="<?php echo htmlspecialchars($article['Photo']); ?>" alt="<?php echo htmlspecialchars($article['Description']); ?>">
        <div class="prix">Prix: €<?php echo htmlspecialchars($article['Prix']); ?></div>
        <div class="vendeur">Vendeur: <?php echo htmlspecialchars($article['IDvendeur']); ?></div>
        <div class="categorie">Catégorie: <?php echo htmlspecialchars($article['Catégorie']); ?></div>
        <div class="description"><?php echo nl2br(htmlspecialchars($article['Description'])); ?></div>
        <?php if($article['Type de vente'] == 'Meilleure offre'): ?>
            <?php if ($_SESSION['Confirmation'] == 1) : ?>
                Proposition réussi <?php echo $_SESSION['Confirmation'] ?>
            <?php endif?>
            <?php $_SESSION['Objet'] = $article['Nom'];
            $_SESSION['IDobjet'] = $article['ID_objet'];?>
            <div class="buttons">
            <form action="Meilleur offre/Offre_BDD.php" method="post">
            <table>
                <tr>
                    <td>Votre offre </td>
                    <td><input type = "number" name="offre"></td>
                    <td><button type="submit" name="Valider">Valider l'offre</button></td>
                </tr>

            </table>
            </form>
        </div>
        <?php elseif ($article['Type de vente'] == 'Achat immediat'): ?>

        <div class="buttons">
            <button onclick="ajouterAuPanier(<?php echo $article['ID_objet']; ?>)">Ajouter au panier</button>
            <button onclick="payerEnUnClic(<?php echo $article['ID_objet']; ?>)">Payer en un clic !</button>
        </div>
    </div>

   
<?php endif?>
</div>

        <footer>
            <p>&copy; 2024 - Agora Francia - Tous droits réservés - <a href="mentions-legales.html">Mentions légales</a></p>
            <p>Développement et design par l'équipe 104</p>
        </footer>
    </div>
</body>
</html>          