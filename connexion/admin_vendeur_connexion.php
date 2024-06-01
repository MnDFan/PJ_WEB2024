<?php 
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Agora Francia</title>
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
                <h3 class="form-title">Connexion à un compte Admin/Vendeur</h3>

                <?php if (isset($_SESSION['LOGGED_ADMIN'])) : ?>
                    Connexion okay admin 
                    <form action="logout.php">
                        <button type="submit">Déconnexion</button>
                    </form>
                <?php elseif (isset($_SESSION['LOGGED_VENDEUR'])) : ?>
                    Connexion okay vendeur
                    <form action="logout.php">
                        <button type="submit">Déconnexion</button>
                    </form>
                <?php else: ?>
                    <form action="login_admin_vendeur.php" method="post">
                        <table>
                            <tr>
                                <td>Login :</td>
                                <td><input type="text" name="identifiant"></td>
                            </tr>
                            <tr>
                                <td>Password :</td>
                                <td><input type = "password" name="passw"></td>
                            </tr>
                            <tr>
                                <td>Type de compte :</td>
                                <td>
                                    <input type="radio" name="choice" value="1">Admin<br>
                                    <input type="radio" name="choice" value="2">Vendeur<br>
                                </td>
                            </tr>
                        </table><br>
                        <button type="submit" name="Valider">Valider</button>
                    </form><br><br>
                    <a href="../compte.php">Vous êtes acheteur ? Cliquez ici pour accéder à votre espace.</a>
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
