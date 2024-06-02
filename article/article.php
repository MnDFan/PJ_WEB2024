<?php
session_start();
$date = date('y-m-d');
$date_modif = date_parse($date);
$jour = $date_modif['day'];
$mois = $date_modif['month'];
$jour= (int)$jour;
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
    <link rel="stylesheet" href="../style.css">
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
            <h1 class="logo" align="center"><a href="index.html"><img src="../Images/logo-agora.png" height="140px"></a></h1>
        </div>
        <br>
        <ul class="dropdownmenu">
            <li><a href="../accueil.php">ACCUEIL</a></li>
            <li><a href="#" style="text-decoration:none">TOUT PARCOURIR</a>
                <ul>
                    <li><a href="../achat_immediat/achat_immediat.php">Achat immédiat</a></li>
                    <li><a href="transaction-vendeur-acheteur.php">Transaction vendeur/client</a></li>
                    <li><a href="../meilleure_offre/meilleure_offre.php">Meilleure offre</a></li>
                </ul>
            </li>
            <li><a href="../notifications.php">NOTIFICATION</a></li>
            <li><a href="../panier.php">PANIER</a></li>
            <li><a href="../compte.php">COMPTE</a></li>
        </ul>
        <br><br><br>
        <div class="content">
            <div class="article-container"><br>
                <h1><?php echo htmlspecialchars($article['Nom']); ?></h1><br>
				                        <div class="description"><?php echo nl2br(htmlspecialchars($article['Description'])); ?></div>
<br><br>
                <div class="article-content">
                    <div class="article-image">
                        <img src="../<?php echo htmlspecialchars($article['Photo']); ?>" alt="<?php echo htmlspecialchars($article['Description']); ?>">
                    </div>
                    <div class="article-details">
                        <h3><div class="prix">Prix : <?php echo htmlspecialchars($article['Prix']); ?>€</div></h3>
                        <?php if($article['IDvendeur'] != '') : ?>
                        <h3><div class="vendeur">Identifiant vendeur : <?php echo htmlspecialchars($article['IDvendeur']); ?></div></h3>
                    <?php else:?>
                        <h3><div class="vendeur">Identifiant vendeur : <?php echo htmlspecialchars($article['IDadmin']); ?></div></h3>
                    <?php endif ?>
                        <h3><div class="categorie">Catégorie : <?php echo htmlspecialchars($article['Categorie']); ?></div></h3>
                        <?php if($article['Type'] == 'Meilleure offre'): ?>
                            <?php $meilleureoffre = 0;?>
                            <?php $sql = "SELECT * FROM meilleureoffre WHERE ID_objet = '$id'";
                                $result = mysqli_query($db_handle, $sql);
                                while($data = mysqli_fetch_assoc($result)) {
                                    if($meilleureoffre < $data['PrixPropose']){
                                        $meilleureoffre = $data['PrixPropose'];
                                    }
                                } ?>
                                <?php $date_offre = date_parse($article['Date_fin']);
                            $jour_fin = $date_offre['day'];
                            $mois_fin = $date_offre['month'];
                            $jour_fin =(int)$jour_fin;
                            $mois_fin = (int)$mois_fin;?>
                            <h3><div class="date">Date début offre: <?php echo htmlspecialchars($article['Date_debut'])?></div></h3>
                            <h3><div class="date">Date fin offre: <?php echo htmlspecialchars($article['Date_fin'])?></div></h3>
                                <h3><div class="meilleure_offreoffre">Meilleure offre : <?php echo htmlspecialchars($meilleureoffre); ?>€</div></h3>
                        <?php endif ?>
                    </div>
                </div><br><br><br>
  
                <div class="buttons form-container">
                    <?php if($article['Type'] == 'Meilleure offre'): ?>
                        <?php if ($jour_fin == $jour AND $mois_fin == $mois):?>
                            <table>
                                <tr>
                                    <td><button name="Valider">Offre terminé</button></td>
                                    <?php if(isset($_SESSION['LOGGED_ADMIN'])):?>
                                    <form action="../meilleure_offre/finaliser_offre_bdd.php" method="post">
                                    <td><button type="submit" name="Valider">Finaliser l'offre</button></td>
                                    <?php if(isset($_SESSION['Gagnant'])):?>
                                        l'acheteur avec l'id <?php echo $_SESSION['Gagnant']?> a remporté le produit
                                    <?php endif?>
                                <?php endif?>
                                </tr>
                            </table>
                        </form>                    
                        <?php else:?>
                        <?php $_SESSION['Objet'] = $article['Nom'];
                        $_SESSION['IDobjet'] = $article['ID_objet']; ?>
                        <?php if (isset($_SESSION['LOGGED_USER'])) : ?>
                        <form action="../meilleure_offre/offre_bdd.php" method="post">
                            <table>
                                <tr>
                                    <td>Votre offre :</td>
                                    <td><input type="number" name="offre"></td>
                                    <td><button type="submit" name="Valider">Valider l'offre</button></td>
                                </tr>
                            </table>
                        </form>

                    <?php else :?>
                        <a href="../compte.php"><button>Se connecter</button></a>
                    <?php endif ?>
                    <?php endif?>
                    <?php elseif ($article['Type'] == 'Achat immediat'): ?>
                        <?php if ($_SESSION['Confirmation'] == 1) : ?>
                            Achat réussi !
                        <?php endif ?>
                       <?php $_SESSION['IDobjet'] = $article['ID_objet']; ?>
                       <?php if (isset($_SESSION['LOGGED_USER'])) : ?>
                        <form action="../achat_immediat/achat_bdd.php" method="post">
                            <button onclick="ajouterAuPanier(<?php echo $article['ID_objet']; ?>)">Ajouter au panier</button><br><br>
                        </form> 
                    <?php else :?>
                        <a href="../compte.php"><button>Se connecter</button></a>
                    <?php endif ?>
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