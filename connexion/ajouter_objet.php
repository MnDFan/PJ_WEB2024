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
                Ajout de l'objet réussi réussi <?php echo $_SESSION['REMPLIR'];?>
            <?php else: ?>
            <div class="form-container">
                <h3 class="form-title">Ajouter un objet</h3>
                <form action="ajouter_bdd_objet.php" method="post">
                    <table>
                        <tr>
                            <td>Nom :</td>
                            <td><input type="text" name="nom"></td>
                        </tr>
                        <tr>
                            <td>Description :</td>
                            <td><input type="text" name="description"></td>
                        </tr>
                         <tr>
                            <td>Prix :</td>
                            <td><input type="number" name="prix"></td>
                        </tr>
                         <tr>
                            <td>Type :</td>
                            <td><input list="type_liste" name="type">
                                <datalist id="type_liste">
                                <option value="Meilleure offre">
                                <option value="Achat immediat">
                                <option value="Transaction">
                            </datalist></td>
                        </tr>
                        <tr>
                            <td>Catégorie :</td>
                            <td><input list="categorie_liste" name="categorie">
                                <datalist id="categorie_liste">
                                <option value="Meilleure offre">
                                <option value="Achat immediat">
                                <option value="Transaction">
                            </datalist></td>
                        </tr>
                         <tr>
                            <td>Photo :</td>
                            <td><input type="text" name="photo"></td>
                        </tr>
                    </table>
							<br>
                    <button type="submit" name="Valider">Valider</button>
                </form>
                
                <?php endif; ?>
                <?php if (isset($_SESSION['Nom'])) : ?>
                    <p class="error-message"><?php echo $_SESSION['Nom']; ?></p>
                <?php endif ?>
                <?php if (isset($_SESSION['Description'])): ?>
                    <p class="error-message"><?php echo  $_SESSION['Description']; ?></p>
                <?php endif ?>
                <?php if (isset($_SESSION['Prix'])) : ?>
                    <p class="error-message"><?php echo  $_SESSION['Prix']; ?></p>
                <?php endif; ?>
                <?php if (isset($_SESSION['Type'])) : ?>
                    <p class="error-message"><?php echo  $_SESSION['Type']; ?></p>
                <?php endif; ?>
                <?php if (isset($_SESSION['Categorie'])) : ?>
                    <p class="error-message"><?php echo  $_SESSION['Categorie']; ?></p>
                <?php endif; ?>
                <?php if (isset($_SESSION['Photo'])) : ?>
                    <p class="error-message"><?php echo  $_SESSION['Photo']; ?></p>
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
