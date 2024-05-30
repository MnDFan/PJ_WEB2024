<?php session_start(); ?>
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
            <li><a href="../Accueil.php">ACCUEIL</a></li>
            <li><a href="#" style="text-decoration:none">TOUT PARCOURIR</a>
                <ul>
                    <li><a href="achat-immediat.html">Achat immédiat</a></li>
                    <li><a href="transaction-vendeur-acheteur.html">Transaction vendeur/client</a></li>
                    <li><a href="meilleure-offre.html">Meilleure offre</a></li>
                </ul>
            </li>
            <li><a href="notifications.html">NOTIFICATION</a></li>
            <li><a href="panier.html">PANIER</a></li>
            <li><a href="Connexion/Compte.php">COMPTE</a></li>
        </ul>
		<br><br><br>

        <div class="content">
            <div class="form-container">
                <p class="form-title">Création d'un compte</p>
                <form action="Creation_bdd.php" method="post">
                    <table>
                        <tr>
                            <td>Nom :</td>
                            <td><input type="text" name="nom"></td>
                        </tr>
                        <tr>
                            <td>Prénom :</td>
                            <td><input type="text" name="prenom"></td>
                        </tr>
                        <tr>
                            <td>E-mail :</td>
                            <td><input type="text" name="email"></td>
                        </tr>
                        <tr>
                            <td>Password :</td>
                            <td><input type="password" name="passw"></td>
                        </tr>
                        <tr>
                            <td>Adresse Ligne 1 :</td>
                            <td><input type="text" name="adresse1"></td>
                        </tr>
                        <tr>
                            <td>Adresse Ligne 2 :</td>
                            <td><input type="text" name="adresse2"></td>
                        </tr>
                        <tr>
                            <td>Ville :</td>
                            <td><input type="text" name="ville"></td>
                        </tr>
                        <tr>
                            <td>Code Postal :</td>
                            <td><input type="number" name="postal"></td>
                        </tr>
                        <tr>
                            <td>Pays :</td>
                            <td><input type="text" name="pays"></td>
                        </tr>
                        <tr>
                            <td>Numéro de téléphone :</td>
                            <td><input type="tel" name="telephone"></td>
                        </tr>
                    </table>
							<br>
                    <button type="submit" name="Valider">Valider</button>
                </form>
                <?php if (isset($_SESSION['Erreurmail'])) : ?>
                    <p class="error-message"><?php echo $_SESSION['Erreurmail']; ?></p>
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
