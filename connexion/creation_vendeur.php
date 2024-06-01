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
            <h1 class="logo" align="center"><a href="../accueil.php"><img src="../Images/logo-agora.png" height="140px"></a></h1>
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
            <?php if ($_SESSION['REMPLIR'] == 'ok') : ?>
                Ajout réussi <?php echo $_SESSION['REMPLIR'];?>
            <?php else: ?>
            <div class="form-container">
                <h3 class="form-title">Création d'un compte</h3>
                <form action="creation_bdd_vendeur.php" method="post">
                    <table>
                        <tr>
                            <td>Pseudo :</td>
                            <td><input type="text" name="pseudo"></td>
                        </tr>
                        <tr>
                            <td>E-mail :</td>
                            <td><input type="text" name="email"></td>
                        </tr>
                        <tr>
                            <td>Mot de passe :</td>
                            <td><input type="text" name="password"></td>
                        </tr>
                    </table>
							<br>
                    <button type="submit" name="Valider">Valider</button>
                </form>
                
                <?php endif; ?>
                <?php if (isset($_SESSION['Erreurmail'])) : ?>
                    <p class="error-message"><?php echo $_SESSION['Erreurmail']; ?></p>
                <?php endif ?>
                <?php if (isset($_SESSION['Mail'])): ?>
                    <p class="error-message"><?php echo  $_SESSION['Mail']; ?></p>
                <?php endif ?>
                <?php if (isset($_SESSION['Pseudo'])) : ?>
                    <p class="error-message"><?php echo  $_SESSION['Pseudo']; ?></p>
                <?php endif; ?>
                <?php if (isset($_SESSION['Password'])) : ?>
                    <p class="error-message"><?php echo $_SESSION['Password']; ?></p>
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
