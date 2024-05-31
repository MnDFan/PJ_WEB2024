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
                    <li><a href="../achat-immediat.php">Achat immédiat</a></li>
                    <li><a href="../transaction-vendeur-acheteur.php">Transaction vendeur/client</a></li>
                    <li><a href="../meilleure-offre.php">Meilleure offre</a></li>
                </ul>
            </li>
            <li><a href="../notifications.php">NOTIFICATION</a></li>
            <li><a href="../panier.php">PANIER</a></li>
            <li><a href="../Compte.php">COMPTE</a></li>
        </ul>
		<br><br><br>

        <div class="content">
            <?php if ($_SESSION['REMPLIR'] == 'ok') : ?>
                Ajout réussi <?php echo $_SESSION['REMPLIR'];?>
            <?php else: ?>
            <div class="form-container">
                <h3 class="form-title">Création d'un compte</h3>
                <form action="Creation_bdd.php" method="post">
                    <table>
                        <tr>
                            <td>Pseudo :</td>
                            <td><input type="text" name="pseudo"></td>
                        </tr>
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
                
                <?php endif; ?>
                <?php if (isset($_SESSION['Login'])) : ?>
                    <?php if (isset($_SESSION['Erreurmail'])) : ?>
                    <p class="error-message"><?php echo $_SESSION['Erreurmail']; ?></p>
                    <?php else: ?>
                        <?php echo  $_SESSION['Login']; ?></p>
                    <?php endif ?>
                <?php endif; ?>
                <?php if (isset($_SESSION['Nom'])) : ?>
                    <p class="error-message"><?php echo  $_SESSION['Nom'] ;?></p>
                <?php endif; ?>
    <?php if (isset($_SESSION['Prenom'])) : ?>
        <p class="error-message"><?php echo  $_SESSION['Prenom']; ?></p>
    <?php endif; ?>
    <?php if (isset($_SESSION['Pseudo'])) : ?>
        <p class="error-message"><?php echo  $_SESSION['Pseudo']; ?></p>
    <?php endif; ?>
    <?php if (isset($_SESSION['Adresse1'])) : ?>
        <p class="error-message"><?php echo $_SESSION['Adresse1']; ?></p>
    <?php endif; ?>
    <?php if (isset($_SESSION['Postal'])) : ?>
        <p class="error-message"><?php echo $_SESSION['Postal']; ?></p>
    <?php endif; ?>
    <?php if (isset($_SESSION['Ville'])) : ?>
        <p class="error-message"><?php echo $_SESSION['Ville']; ?></p>
    <?php endif; ?>
    <?php if (isset($_SESSION['Pays'])) : ?>
        <p class="error-message"><?php echo $_SESSION['Pays']; ?></p>
    <?php endif; ?>
    <?php if (isset($_SESSION['Tel'])) : ?>
        <p class="error-message"><?php echo $_SESSION['Tel']; ?></p>
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
