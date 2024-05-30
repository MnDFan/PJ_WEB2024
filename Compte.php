<?php 
session_start(); 
$_SESSION['Erreurmail'] = ''?>
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
            <h1 class="logo" align="center"><a href="index.html"><img src="Images/logo-agora.png" height="140px"></a></h1>
        </div>
        <br>
        <ul class="dropdownmenu">
            <li><a href="Accueil.php">ACCUEIL</a></li>
            <li><a href="#" style="text-decoration:none">TOUT PARCOURIR</a>
                <ul>
                    <li><a href="achat-immediat.html">Achat immédiat</a></li>
                    <li><a href="transaction-vendeur-acheteur.html">Transaction vendeur/client</a></li>
                    <li><a href="meilleure-offre.html">Meilleure offre</a></li>
                </ul>
            </li>
            <li><a href="notifications.html">NOTIFICATION</a></li>
            <li><a href="panier.html">PANIER</a></li>
            <li><a href="Compte.php">COMPTE</a></li>
        </ul>
        <div class="content">
            
		<form action="Connexion/Login.php" method="post">
            <table>
                <tr>
                    <td>Connexion</td>
                </tr>
                <tr>
                    <td>Login :</td>
                    <td><input type="text" name="identifiant"></td>
                </tr>
                <tr>
                    <td>Password :</td>
                    <td><input type = "password" name="passw"></td>
                </tr>

            </table>
            <button type="submit" name="Valider">Connexion</button>
        </form>
        <form action="Connexion/Logout.php">
            <button type="submit">Déconnexion</button>
        </form>
        <a href="Connexion/Creation.php">Pas de compte ? Créer en un en cliquant ici</a></br>
        <a href="Connexion/Admin_Vendeur_Connexion.php">Admin ou vendeur ?</a>
    <?php if (isset($_SESSION['LOGGED_USER'])) : ?>
        Connexion okay. <?php echo $_SESSION['LOGGED_USER']; ?>
    <?php endif; ?>
		
		
		
        </div>
        <footer>
            <p>&copy; 2024 - Agora Francia - Tous droits réservés - <a href="mentions-legales.html">Mentions légales</a></p>
            <p>Développement et design par l'équipe 104</p>
        </footer>
    </div>
</body>
</html>																																																																																																																				