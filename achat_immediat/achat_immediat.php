<?php
session_start();
$_SESSION['ID'] = -1;
$_SESSION['Confirmation'] = 0;
$_SESSION['Confirmation_panier'] = 0;
// Connexion à la base de données
$nombreligne = 0;
$nombreligne = (int)$nombreligne;
$database = "agora";
//connectez-vous dans votre BDD
//Rappel : votre serveur = localhost: | votre login = root | votre mot de pass = '' (rien)
$db_handle = mysqli_connect('localhost', 'root', '');
$db_found = mysqli_select_db($db_handle, $database);
// Vérifiez la connexion
if ($db_found) {
    // Récupérer les informations des articles
    $sql = "SELECT * FROM objet WHERE Type = 'Achat immediat'";
    $result = mysqli_query($db_handle, $sql);

    // Vérifier s'il y a des résultats
    if ($result->num_rows > 0) {
        $articles = $result->fetch_all(MYSQLI_ASSOC);
    } else {
        $articles = [];
    }
} else {
    echo "Database not found";
} //end else

// Fermer la connexion
mysqli_close($db_handle);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Agora Francia</title>
    <link rel="stylesheet" href="../style.css">
    <style>
        body {
            background-image: url('../Images/background.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }
        .content table {
            width: 100%;
            text-align: center;
        }
        .content table img {
            display: block;
            margin: auto;
            max-width: 100%; /* Make sure images do not exceed the width of their container */
            height: auto; /* Maintain aspect ratio */
        }
        .content table p {
            text-align: center;
        }
        td {
            padding: 10px; /* Add some padding around each cell for better spacing */
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div>
            <h1 class="logo" align="center"><a href="../accueil.php"><img src="../Images/logo-agora.png" height="140px"></a></h1>
        </div>
        <br>
<ul class="dropdownmenu">
            <li><a href="../accueil.php">ACCUEIL</a></li>
            <li><a href="#" style="text-decoration:none">TOUT PARCOURIR</a>
                <ul>
                    <li><a href="achat_immediat.php">Achat immédiat</a></li>
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
            <div class="form-container">
                <h1>Bienvenue sur notre boutique</h1>
                <table>
                    <tr>
                        <?php foreach ($articles as $article): ?>
                            <?php if($nombreligne < 5): ?>
                            <td>
                                <a href="../article/article.php?id=<?php echo $article['ID_objet']; ?>">
                                    <img src="../<?php echo htmlspecialchars($article['Photo']); ?>" alt="<?php echo htmlspecialchars($article['Nom']); ?> "height='240' width='300'/>
                                    <p><?php echo htmlspecialchars($article['Nom']); ?></p>
                                </a>
                            </td>
                            <?php $nombreligne = $nombreligne + 1; ?>
                        <?php endif ?>
                        <?php if($nombreligne == 4): ?>
                        </tr>
                        <tr>
                            <?php $nombreligne = 0; ?>
                        <?php endif ?>
                        <?php endforeach; ?>
                    </tr>
                </table>
            </div>
        </div>
        <br><br><br>
        <footer>
            <p>&copy; 2024 - Agora Francia - Tous droits réservés - <a href="mentions-legales.html">Mentions légales</a></p>
            <p>Développement et design par l'équipe 104</p>
        </footer>
    </div>
</body>
</html>
