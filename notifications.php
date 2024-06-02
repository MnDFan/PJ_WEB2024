<?php
session_start();
$database = "agora";

$db_handle = mysqli_connect('localhost', 'root', 'root'); //ENLEVER ROOT EN MDP
$db_found = mysqli_select_db($db_handle, $database);

if ($db_found) {
    $user_id = $_SESSION['user_id']; //RÉCUPÉRER L'UTILISATEUR CONNECTÉ
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["create_alert"])) {
            $type_article = $_POST["type_article"];
            $type_achat = $_POST["type_achat"];
            $prix_min = $_POST["prix_min"];
            $prix_max = $_POST["prix_max"];

            $id_notification = uniqid();

            $sql = "INSERT INTO notification (IDnotification, IDacheteur, Type_article, Type_achat, Prix_min, Prix_max) 
                   VALUES ('$id_notification', '$user_id', '$type_article', '$type_achat', '$prix_min', '$prix_max')";
            mysqli_query($db_handle, $sql);
        }

        if (isset($_POST["delete_alert"])) {
            $alert_id = $_POST["alert_id"];
            $sql = "DELETE FROM notification WHERE IDnotification=$alert_id";
            mysqli_query($db_handle, $sql);
        }
    }

    $sql = "SELECT * FROM notification";
    $alerts_result = mysqli_query($db_handle, $sql);
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
            <h1 class="logo" align="center"><a href="index.html"><img src="./Images/logo-agora.png" height="140px"></a></h1>
        </div>
        <br>
        <ul class="dropdownmenu">
            <li><a href="Accueil.html">ACCUEIL</a></li>
            <li><a href="#" style="text-decoration:none">TOUT PARCOURIR</a>
                <ul>
                    <li><a href="achat-immediat.php">Achat immédiat</a></li>
                    <li><a href="transaction-vendeur-acheteur.html">Transaction vendeur/client</a></li>
                    <li><a href="meilleure-offre.html">Meilleure offre</a></li>
                </ul>
            </li>
            <li><a href="notifications.php">NOTIFICATION</a></li>
            <li><a href="panier.html">PANIER</a></li>
            <li><a href="Compte.php">COMPTE</a></li>
        </ul>
        <div class="content">
            <h1>Créer une alerte</h1>
            <form method="post" action="">
                <label for="type_article">Type d'article :</label>
                <select id="type_article" name="type_article" required>
                    <option value="Articles hauts de gamme">Articles hauts de gamme</option>
                    <option value="Articles rares">Articles rares</option>
                    <option value="Articles réguliers">Articles réguliers</option>
                </select><br>
                <label for="type_achat">Type d'achat :</label>
                <select id="type_achat" name="type_achat" required>
                    <option value="Achat immédiat">Achat immédiat</option>
                    <option value="Transaction vendeur/client">Transaction vendeur/client</option>
                    <option value="Meilleure offre">Meilleure offre</option>
                </select><br>
                <label for="prix_min">Prix minimum :</label><br>
                <input type="number" id="prix_min" name="prix_min"><br>
                <label for="prix_max">Prix maximum :</label><br>
                <input type="number" id="prix_max" name="prix_max"><br><br>
                <input type="submit" name="create_alert" value="Créer l'alerte">
            </form>

            <h1>Alertes existantes</h1>
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

            <h1>Produits correspondant à vos alertes</h1>
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
                                     AND Catégorie = '$type_article' 
                                     AND Prix BETWEEN $Prix_min AND $Prix_max";
                    $result_products = mysqli_query($db_handle, $sql_products);

                    if ($result_products && mysqli_num_rows($result_products) > 0) {
                        while($product = mysqli_fetch_assoc($result_products)) {
                            echo "<div>";
                            echo "<img src='" . $product["Photo"] . "' alt='Photo de l'article' width='100'><br>";
                            echo "<strong>" . $product["Nom"] . "</strong><br>";
                            echo $product["description"] . "<br>";
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
        </div>
        <footer>
            <p>&copy; 2024 - Agora Francia - Tous droits réservés - <a href="mentions-legales.html">Mentions légales</a></p>
            <p>Développement et design par l'équipe 104</p>
        </footer>
    </div>
</body>
</html>