<?php
session_start();
// Connexion à la base de données
$database = "agora";
$db_handle = mysqli_connect('localhost', 'root', '');
$db_found = mysqli_select_db($db_handle, $database);

// Vérifiez la connexion
if ($db_found) {
    // Récupérer id de l'article
    if ($_SESSION['ID'] == -1) {
        $id = $_GET['id'];
        $_SESSION['ID'] = $id;
    } else {
        $id = $_SESSION['ID'];
        $id = (int)$id;
    }

    // Préparer et exécuter la requête
    $sql = "SELECT * FROM objet WHERE ID_objet = '$id'";
    $result = mysqli_query($db_handle, $sql);

    // Vérifier si l'article existe
    if ($result->num_rows > 0) {
        $article = $result->fetch_assoc();
    } else {
        echo "Article non trouvé." . $id;
        exit;
    }
} else {
    echo "Database not found";
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Agora Francia</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .content {
            background-color: white;
            width: 90%;
            margin: auto;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }
        .article-container {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .article-content {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
        }
        .article-container img {
            max-width: 100%;
            max-height: 400px;
            border-radius: 10px;
        }
        .article-image, .article-details {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .article-details {
            flex-direction: column;
            text-align: left;
        }
        .article-details > * {
            margin: 10px 0;
            text-align: left;
        }
        .buttons {
            margin-top: 20px;
            text-align: center;
        }
        .form-container {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            display: inline-block;
        }
        h1 {
            text-align: center;
            width: 100%;
        }
        table {
            margin: auto;
        }
    </style>
    <script>
        function ajouterAuPanier(id) {
            alert("Article " + id + " ajouté au panier!");
        }

        function payerEnUnClic(id) {
            alert("Paiement en 1 clic pour l'article " + id + "!");
        }
    </script>
</head>
<body>
    <div class="wrapper">
        <div>
            <h1 class="logo" align="center"><a href="index.html"><img src="Images/logo-agora.png" height="140px"></a></h1>
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
            <li><a href="Compte.php">COMPTE</a></li>
        </ul>
        <br><br><br>
        <div class="content">
            <div class="article-container"><br>
                <h1><?php echo htmlspecialchars($article['Nom']); ?></h1><br>
				                        <div class="description"><?php echo nl2br(htmlspecialchars($article['Description'])); ?></div>
<br><br>
                <div class="article-content">
                    <div class="article-image">
                        <img src="<?php echo htmlspecialchars($article['Photo']); ?>" alt="<?php echo htmlspecialchars($article['Description']); ?>">
                    </div>
                    <div class="article-details">
                        <h3><div class="prix">Prix : <?php echo htmlspecialchars($article['Prix']); ?>€</div></h3>
                        <h3><div class="vendeur">Identifiant vendeur : <?php echo htmlspecialchars($article['IDvendeur']); ?></div></h3>
                        <h3><div class="categorie">Catégorie : <?php echo htmlspecialchars($article['Catégorie']); ?></div></h3>
                    </div>
                </div><br><br><br>
                <div class="buttons form-container">
                    <?php if($article['Type'] == 'Meilleure offre'): ?>
                        <?php if ($_SESSION['Confirmation'] == 1) : ?>
                            Proposition réussie <?php echo $_SESSION['Confirmation']; ?>
                        <?php endif ?>
                        <?php $_SESSION['Objet'] = $article['Nom'];
                        $_SESSION['IDobjet'] = $article['ID_objet']; ?>
                        <form action="Meilleur offre/Offre_BDD.php" method="post">
                            <table>
                                <tr>
                                    <td>Votre offre :</td>
                                    <td><input type="number" name="offre"></td>
                                    <td><button type="submit" name="Valider">Valider l'offre</button></td>
                                </tr>
                            </table>
                        </form>
                    <?php elseif ($article['Type'] == 'Achat immediat'): ?>
                        <?php if ($_SESSION['Confirmation'] == 1) : ?>
                            Achat réussi !
                        <?php endif ?>
                        <button onclick="ajouterAuPanier(<?php echo $article['ID_objet']; ?>)">Ajouter au panier</button><br><br>
                        <button onclick="payerEnUnClic(<?php echo $article['ID_objet']; ?>)">Payer en un clic !</button>
                    <?php endif ?>
                </div>
            </div><br><br>
        </div>
        <br><br><br>
        <footer>
            <p>&copy; 2024 - Agora Francia - Tous droits réservés - <a href="mentions-legales.html">Mentions légales</a></p>
            <p>Développement et design par l'équipe 104</p>
        </footer>
    </div>
</body>
</html>
