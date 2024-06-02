<?php 
session_start(); 
$_SESSION['Erreurmail'] = '';
$_SESSION['Mail'] = '';
$_SESSION['Pseudo'] = '';
$_SESSION['Password'] = '';
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
            <div class="form-container">
                            
                <?php if (isset($_SESSION['LOGGED_USER'])) : ?>
                    <h3 class="form-title">Bienvenue <?php echo $_SESSION['LOGGED_USER'] ?></h3>
        <form action="connexion/logout.php">
            <button type="submit">Déconnexion</button>
        </form>
    <?php elseif (isset($_SESSION['LOGGED_ADMIN'])) : ?>
        <?php $_SESSION['ID_VENDEUR'] = '';?>
        <h3 class="form-title">Bienvenue <?php echo $_SESSION['LOGGED_ADMIN'] ?></h3>
        <form action="connexion/creation_vendeur.php">
            <button type="submit">Ajouter un vendeur </button>
        </form>
        </br>
        <form action="connexion/supprimer_vendeur.php">
            <button type="submit">Supprimer un vendeur </button>
        </form>
        </br>
        <form action="connexion/ajouter_objet.php">
            <button type="submit">Ajouter un produit</button>
        </form>
        </br>
        <form action="connexion/logout.php">
            <button type="submit">Déconnexion</button>
        </form>
    <?php elseif (isset($_SESSION['LOGGED_VENDEUR'])) : ?>
        <style>
            body {
                background: url('<?php echo $_SESSION['Background'] ?>');
            }
        </style>
        <h3 class="form-title">Bienvenue <?php echo $_SESSION['LOGGED_VENDEUR'] ?></h3>
        <img src="<?php echo $_SESSION['Photo']?>">
        <form action="connexion/ajouter_objet.php">
            <button type="submit">Ajouter un produit</button>
        </form>
    </br>
        <form action="connexion/supprimer_objet.php">
            <button type="submit">Supprimer un produit</button>
        </form>
        <br>
        <form action="connexion/logout.php">
            <button type="submit">Déconnexion</button>
        </form><br>

    <?php else: ?>
        <?php $_SESSION['ID_VENDEUR'] = '';?>

        <h1 style="font-family: 'Avenir', sans-serif;">Connexion à un compte</h3>
    <div class="form-container">
        <form action="connexion/login_acheteur.php" method="post">
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
        
        <a href="connexion/creation.php">Vous ne possedez pas de compte ? Créez-en un en cliquant ici.</a></br><br>
        <a href="connexion/admin_vendeur_connexion.php">Cliquez ici pour accéder à l'espace Admin/Vendeur.</a>

        <?php endif; ?>
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