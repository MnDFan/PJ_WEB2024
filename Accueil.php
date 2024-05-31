<?php 
session_start(); 
$database = "agora";
$objet1 = '';
$objet2 = '';
$objet3 = '';
$objet4 = '';
$nombreobjet = 0;
$nombreobjet = (int)$nombreobjet;

$db_handle = mysqli_connect('localhost', 'root', '' );
$db_found = mysqli_select_db($db_handle, $database);
if ($db_found) {
    $sql = "SELECT * FROM objet";
    $result = mysqli_query($db_handle, $sql);
    while ($data = mysqli_fetch_assoc($result)) {
        $nombreobjet = $nombreobjet + 1;
    }
    $sql = "SELECT * FROM objet WHERE ID_objet = '$nombreobjet'";
    $result = mysqli_query($db_handle, $sql);
    while ($data = mysqli_fetch_assoc($result)) {
        $objet1 = $data['Photo'];
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Agora Francia</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* Spécifique à la page d'accueil */
        .home-container {
            max-width: 90%;
            margin: auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .home-container table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0 10px;
        }
        .home-container td {
            padding: 10px;
            border: none;
        }
        .home-container h2, .home-container p {
            margin: 20px 0;
            padding: 0 40px;
        }
        .home-container p {
            text-align: justify;
            font-size: 16px;
            line-height: 1.6;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div>
            <h1 class="logo" align="center"><a href="accueil.php"><img src="./Images/logo-agora.png" height="140px"></a></h1>
        </div>
        <br>
        <ul class="dropdownmenu">
            <li><a href="../index.php">ACCUEIL</a></li>
            <li><a href="#" style="text-decoration:none">TOUT PARCOURIR</a>
                <ul>
                    <li><a href="achat-immediat.php">Achat immédiat</a></li>
                    <li><a href="transaction-vendeur-acheteur.php">Transaction vendeur/client</a></li>
                    <li><a href="meilleure-offre.php">Meilleure offre</a></li>
                </ul>
            </li>
            <li><a href="notifications.php">NOTIFICATION</a></li>
            <li><a href="panier.php">PANIER</a></li>
            <li><a href="compte.php">COMPTE</a></li>
        </ul>
        <br><br><br>
        <div class="content">
            <div class="home-container">
                <h2>Présentation d'Agora Francia</h2>
                <p>Bienvenue sur Agora Francia, votre plateforme de confiance pour l'achat et la vente de biens en ligne.</p>
            </div>
            <br>
            <div class="home-container">
                <h2>Sélection du jour</h2>
                <table>
                    <tr>
                        <td><?php echo "<img src='$objet1' height='240'>" ?></td>
                        <td><?php echo "<img src='$objet1' height='240'>" ?></td>
                        <td><?php echo "<img src='$objet1' height='240'>" ?></td>
                        <td><?php echo "<img src='$objet1' height='240'>" ?></td>
                    </tr>
                </table>
            </div>
            <br>
            <div class="home-container">
                <h2>Info Pratique</h2>
                <p>Toutes les informations pratiques pour utiliser notre plateforme.</p>
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
