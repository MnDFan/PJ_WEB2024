<?php
// Connexion à la base de données
$database = "agora";
//connectez-vous dans votre BDD
//Rappel : votre serveur = localhost: | votre login = root | votre mot de pass = '' (rien)
$db_handle = mysqli_connect('localhost', 'root', 'root');
$db_found = mysqli_select_db($db_handle, $database);
 //si le BDD existe, faire le traitement

// Vérifiez la connexion
if ($db_found) {
   
// Récupérer les informations des articles
$sql = "SELECT ID_objet, Nom, Description FROM objet";
$result = $conn->query($sql);

// Vérifier s'il y a des résultats
if ($result->num_rows > 0) {
    $articles = $result->fetch_all(MYSQLI_ASSOC);
} else {
    $articles = [];
}
}
//si le BDD n'existe pas
else {
 echo "Database not found";
}//end else

// Fermer la connexion
mysqli_close($db_handle);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page d'Achat Immédiat - Boutique</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }
        img {
            width: 100px;
            height: auto;
        }
        a {
            text-decoration: none;
        }
    </style>
</head>
<body>
    <h1>Bienvenue sur notre boutique</h1>
    <table>
        <tr>
            <?php foreach ($articles as $article): ?>
                <td>
                    <a href="article.php?id=<?php echo $article['ID_objet']; ?>">
                        <img src="<?php echo htmlspecialchars($article['Photo']); ?>" alt="<?php echo htmlspecialchars($article['Nom']); ?>">
                        <p><?php echo htmlspecialchars($article['Nom']); ?></p>
                    </a>
                </td>
            <?php endforeach; ?>
        </tr>
    </table>
</body>
</html>
