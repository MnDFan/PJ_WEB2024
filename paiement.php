<?php 
session_start(); ?>

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
            <h1 class="logo" align="center"><a href="accueil.php"><img src="Images/logo-agora.png" height="140px"></a></h1>
        </div>
        <br>
        <ul class="dropdownmenu">
            <li><a href="accueil.php">ACCUEIL</a></li>
            <li><a href="#" style="text-decoration:none">TOUT PARCOURIR</a>
                <ul>
                    <li><a href="achat_immediat/achat_immediat.php">Achat immédiat</a></li>
                    <li><a href="transaction-vendeur-acheteur.php">Transaction vendeur/client</a></li>
                    <li><a href="meilleure_offre/meilleure_offre.php">Meilleure offre</a></li>
                </ul>
            </li>
            <li><a href="notifications.php">NOTIFICATION</a></li>
            <li><a href="panier.php">PANIER</a></li>
            <li><a href="compte.php">COMPTE</a></li>
        </ul>
        <br>
        <div class="content">
            <h1 style="font-family: 'Avenir', sans-serif;">Paiement</h3>
    <div class="form-container">
        <?php if ($_SESSION['REMPLIR'] != '') : ?>
            Paiement réussi <?php echo $_SESSION['REMPLIR']?>
        <?php else:?>

        <form action="paiement_bdd.php" method="post">
            <table>
                <tr>
                             <td>Type de carte :</td>
                            <td><input list="type_carte_liste" name="type_carte">
                                <datalist id="type_carte_liste">
                                <option value="VISA">
                                <option value="Master Card">
                                <option value="Amex">
                                <option value="Paypal">
                            </datalist></td>
                        </tr>
                        <tr>
                            <td>Numéro de carte :</td>
                            <td><input type="number" name="numcarte"></td>
                        </tr>
                        <tr>
                            <td>Nom sur la carte :</td>
                            <td><input type="text" name="nomcarte"></td>
                        </tr>
                        <tr>
                            <td>Expire :</td>
                            <td><input type="date" name="expirationcarte"></td>
                        </tr>
                        <tr>
                            <td>CVV :</td>
                            <td><input type="number" name="cvv"></td>
                        </tr>

            </table><br>
            <button type="submit" name="Valider">Payer</button>
        </form>
    <?php if (isset($_SESSION['Typecarte'])) : ?>
        <p class="error-message"><?php echo $_SESSION['Typecarte']; ?></p>
    <?php endif; ?>
    <?php if (isset($_SESSION['Numcarte'])) : ?>
        <p class="error-message"><?php echo $_SESSION['Numcarte']; ?></p>
    <?php endif; ?>
    <?php if (isset($_SESSION['Nomcarte'])) : ?>
        <p class="error-message"><?php echo $_SESSION['Nomcarte']; ?></p>
    <?php endif; ?>
    <?php if (isset($_SESSION['Expirecarte'])) : ?>
        <p class="error-message"><?php echo $_SESSION['Expirecarte']; ?></p>
    <?php endif; ?>
    <?php if (isset($_SESSION['CVV'])) : ?>
        <p class="error-message"><?php echo $_SESSION['CVV']; ?></p>
    <?php endif; ?>
        <br><br>
        <?php endif ?>
                            
    
        </div>
        </div>
        <br>
        <p><button class="DarkMode" onclick="DarkMode()">assombrir</button></p>
        <script>
             function DarkMode() {
                var element = document.body;
                element.classList.toggle("dark-mode");
              }   
        </script>
        
        <footer>
            

            <p>&copy; 2024 - Agora Francia - Tous droits réservés - <a href="mentions-legales.html">Mentions légales</a></p>
            <p>Développement et design par l'équipe 104</p>
        </footer>
    </div>
</body>
</html>