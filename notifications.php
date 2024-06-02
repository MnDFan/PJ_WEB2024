<?php
session_start();
$database = "agora";

$db_handle = mysqli_connect('localhost', 'root', ''); //ENLEVER ROOT EN MDP
$db_found = mysqli_select_db($db_handle, $database);

if ($db_found) {
    if (isset($_SESSION['LOGGED_USER'])){
    $user_id = $_SESSION['ID_ACHETEUR']; //RÉCUPÉRER L'UTILISATEUR CONNECTÉ
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["create_alert"])) {
            $type_article = $_POST["type_article"];
            $type_achat = $_POST["type_achat"];
            $prix_min = $_POST["prix_min"];
            $prix_max = $_POST["prix_max"];

            $sql = "INSERT INTO notification  (IDacheteur, Type_article, Type_achat, Prix_min, Prix_max) 
                   VALUES ( '$user_id', '$type_article', '$type_achat', '$prix_min', '$prix_max')";
            $result = mysqli_query($db_handle, $sql);
        }

        elseif (isset($_POST["delete_alert"])) {
            $alert_id = $_POST["alert_id"];
            $sql = "DELETE FROM notification WHERE IDnotification=$alert_id";
            $result = mysqli_query($db_handle, $sql);
        }
    }

    $sql = "SELECT * FROM notification";
    $alerts_result = mysqli_query($db_handle, $sql);
}
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Notifications</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="wrapper">
        <div>
            <h1 class="logo" align="center"><a href="accueil.php"><img src="./Images/logo-agora.png" height="140px"></a></h1>
        </div>
        <br>
        <ul class="dropdownmenu">
            <li><a href="accueil.php">ACCUEIL</a></li>
            <li><a href="#" style="text-decoration:none">TOUT PARCOURIR</a>
                <ul>
                    <li><a href="achat_immediat/achat_immediat.php">Achat immédiat</a></li>
                    <li><a href="transaction-vendeur-acheteur/transaction-vendeur-acheteur.html">Transaction vendeur/client</a></li>
                    <li><a href="meilleure_offre/meilleure_offre.php">Meilleure offre</a></li>
                </ul>
            </li>
            <li><a href="notifications.php">NOTIFICATION</a></li>
            <li><a href="panier.php">PANIER</a></li>
            <li><a href="compte.php">COMPTE</a></li>
        </ul>
        <br>
        <div class="content">
            <h1>Notifications</h1>
            <div class="form-container">
                <?php if (isset($_SESSION['LOGGED_USER'])) : ?>
            <h1 style="font-family: 'Avenir', sans-serif;">Créer une alerte</h1>
           <div class="form-container">
            <form method="post" action="">
                <label for="type_article">Type d'article :</label>
                <select id="type_article" name="type_article" required>
                    <option value="Articles hauts de gamme">Articles hautes de gamme</option>
                    <option value="Articles rares">Articles rare</option>
                    <option value="Articles réguliers">Articles réguliers</option>
                </select><br>
                <label for="type_achat">Type d'achat : </label>
                <select id="type_achat" name="type_achat" required>
                    <option value="Achat immédiat">Achat immédiat</option>
                    <option value="Transaction vendeur/client">Transaction vendeur/client</option>
                    <option value="Meilleure offre">Meilleure offre</option>
                </select><br>
                <label for="prix_min">Prix minimum :</label><br>
                <input type="number" id="prix_min" name="prix_min"><br>
                <label for="prix_max">Prix maximum :</label><br>
                <input type="number" id="prix_max" name="prix_max"><br><br>
                <button type="submit" name="create_alert">Créer l'alerte</button>
            </form>
            </div> 

            <h1 style="font-family: 'Avenir', sans-serif;">Alertes existantes</h1>
            <div class="form-container">
            <table>
                <tr>
                    <th>Type d'article</th>
                    <th>Type d'achat</th>
                    <th>Prix minimum</th>
                    <th>Prix maximum</th>
                    <th>Actions</th>
                </tr>
                <?php
                if ($alerts_result && mysqli_num_rows($alerts_result) > 0) {
                    while($alert = mysqli_fetch_assoc($alerts_result)) {
                        $alert_id = $alert["IDnotification"];
                        $Type_article = $alert["Type_article"];
                        $Type_achat = $alert["Type_achat"];
                        $Prix_min = $alert["Prix_min"];
                        $Prix_max = $alert["Prix_max"];

                        echo "<tr>";
                        echo "<form method='post' action=''>";
                        echo "<td><input type='text' name='type_article' value='$Type_article'></td>";
                        echo "<td><input type='text' name='type_achat' value='$Type_achat'></td>";
                        echo "<td><input type='number' name='prix_min' value='$Prix_min'></td>";
                        echo "<td><input type='number' name='prix_max' value='$Prix_max'></td>";
                        echo "<td>
                                <input type='hidden' name='alert_id' value='$alert_id'>
                                <input type='submit' name='delete_alert' value='Supprimer'>
                              </td>";
                        echo "</form>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>Aucune alerte enregistrée</td></tr>";
                }
                ?>
            </table>
            </div>

            <h1 style="font-family: 'Avenir', sans-serif;">Produits correspondant</h1>
            <div class="form-container">
            <?php
            if ($alerts_result && mysqli_num_rows($alerts_result) > 0) {
                mysqli_data_seek($alerts_result, 0);
                while($alert = mysqli_fetch_assoc($alerts_result)) {
                    $alert_id = $alert["IDnotification"];
                    $Type_article = $alert["Type_article"];
                    $Type_achat = $alert["Type_achat"];
                    $Prix_min = $alert["Prix_min"];
                    $Prix_max = $alert["Prix_max"];

                    $sql_products = "SELECT * FROM objet WHERE Type = '$Type_achat' 
                                     AND Categorie = '$Type_article' 
                                     AND Prix BETWEEN $Prix_min AND $Prix_max";
                    $result_products = mysqli_query($db_handle, $sql_products);

                    if ($result_products && mysqli_num_rows($result_products) > 0) {
                        while($product = mysqli_fetch_assoc($result_products)) {
                            echo "<div>";
                            echo "<img src='" . $product["Photo"] . "' alt='Photo de l'article' width='100'><br>";
                            echo "<strong>" . $product["Nom"] . "</strong><br>";
                            echo $product["Description"] . "<br>";
                            echo "Prix : " . $product["Prix"] . " €<br>";
                            echo "</div><hr>";
                        }
                    } else {
                        echo "<p>Aucun produit ne correspond à cette alerte.</p>";
                    }
                }
            } else {
                echo "<p>Aucune alerte enregistrée.</p>";
            }

            mysqli_close($db_handle);
            ?>
            <?php else :?>
                        <a href="compte.php"><button>Se connecter</button></a>
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