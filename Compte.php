<?php 
session_start(); 
$_SESSION['Erreurmail'] = '';
$_SESSION['Nom'] = '';
$_SESSION['Prenom'] = '';
$_SESSION['Adresse1'] = '';
$_SESSION['Adresse2'] = '';
$_SESSION['Ville'] = '';
$_SESSION['Postal'] = '';
$_SESSION['Pays'] = '';
$_SESSION['Tel'] = '';
$_SESSION['Login'] = '';
$_SESSION['REMPLIR'] = '';?>
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
        <br><br><br>
        <div class="content">
            <div class="form-container">
			                <h3 class="form-title">Connexion à un compte</h3>

				<?php if (isset($_SESSION['LOGGED_USER'])) : ?>

        Connexion okay. <?php echo $_SESSION['LOGGED_USER']; ?>
        <form action="Connexion/Logout.php">
            <button type="submit">Déconnexion</button>
        </form>
        //Met en avant la page Admin, vendeur ou acheteur ou demande de se connecter
    <?php elseif (isset($_SESSION['LOGGED_ADMIN'])) : ?>
        Connexion okay admin 
        <form action="Connexion/Logout.php">
            <button type="submit">Déconnexion</button>
        </form>
    <?php elseif (isset($_SESSION['LOGGED_VENDEUR'])) : ?>
        Connexion okay vendeur
        <form action="Connexion/Logout.php">
            <button type="submit">Déconnexion</button>
        </form><br>
    <?php else: ?>
		<form action="Connexion/Login.php" method="post">
            <table>
                <tr>
                    <td>Login :</td>
                    <td><input type="text" name="identifiant"></td>
                </tr>
                <tr>
                    <td>Password :</td>
                    <td><input type = "password" name="passw"></td>
                </tr>

            </table><br>
            <button type="submit" name="Valider">Connexion</button>
        </form><br><br>
        
        <a href="Connexion/Creation.php">Vous ne possedez pas de compte ? Créez-en un en cliquant ici.</a></br><br>
        <a href="Connexion/Admin_Vendeur_Connexion.php">Cliquez ici pour accéder à l'espace Admin/Vendeur.</a>

		<?php endif; ?>
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