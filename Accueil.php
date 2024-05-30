<?php 
session_start(); 
//session_destroy();
//identifier le nom de base de données
$database = "agora";
$objet1 = '';
$objet2 = '';
$objet3 = '';
$objet4 = '';
$nombreobjet = 0;
$nombreobjet = (int)$nombreobjet;
//connectez-vous dans votre BDD
//Rappel : votre serveur = localhost | votre login = root | votre mot de pass = '' (rien)
$db_handle = mysqli_connect('localhost', 'root', '' );
$db_found = mysqli_select_db($db_handle, $database);
if ($db_found) {
    $sql = "SELECT * FROM objet" ;
    $result = mysqli_query($db_handle, $sql);
    while ($data = mysqli_fetch_assoc($result)) {  //On compte le nombre d'objet sur le site
        $nombreobjet = $nombreobjet + 1;
    }
    $sql = "SELECT * FROM objet WHERE ID_objet = '$nombreobjet'" ; //On mettra $nombreobjet - 1 pour avoir les derniers objets de la liste
    $result = mysqli_query($db_handle, $sql);
    while ($data = mysqli_fetch_assoc($result)) {
        $objet1 = $data['Photo'];
    }


}?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Agora Francia</title>
    <link rel="stylesheet" href="style.css">
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
            <div>
                <h2>Présentation d'Agoria Francia</h2>
                //La tu met un texte qui decrit le site
            </div>
            <div>
                <h2>Sélection du jour</h2>
                <table>
                    <tr>
                        <td><?php echo "<img src='$objet1' height='240'>" ?></td>  //je vais modifier les images après
                        <td><?php echo "<img src='$objet1' height='240'>" ?></td>
                        <td><?php echo "<img src='$objet1' height='240'>" ?></td>
                        <td><?php echo "<img src='$objet1' height='240'>" ?></td>
                    </tr>
                </table>
            </div>
            <div>
                 <h2>Info Pratique</h2>
            </div>
        </div>
        <footer>
            <p>&copy; 2024 - Agora Francia - Tous droits réservés - <a href="mentions-legales.html">Mentions légales</a></p>
            <p>Développement et design par l'équipe 104</p>
        </footer>
    </div>
</body>
</html>																																																																																																																				
