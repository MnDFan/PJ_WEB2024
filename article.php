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
   
// Récupérer id de l'article
$id = $_GET['id'];

//Preparer et exécuter la requête

$sql = "SELECT * FROM objet WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

// Vérifier si l'article existe
if ($result->num_rows > 0) {
    $article = $result->fetch_assoc();
} else {
    echo "Article non trouvé.";
    exit;
}
}

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
    <title><?php echo htmlspecialchars($article['description']); ?></title>
    <style>
        .article-container {
            max-width: 600px;
            margin: 0 auto;
            text-align: center;
            border: 1px solid #ddd;
            padding: 20px;
            border-radius: 10px;
        }
        img {
            max-width: 100%;
            height: auto;
        }
        .price {
            color: #b12704;
            font-size: 1.5em;
            margin: 10px 0;
        }
        .vendor, .category, .description {
            margin: 10px 0;
        }
        .buttons {
            margin-top: 20px;
        }
        .buttons button {
            padding: 10px 20px;
            margin: 5px;
            font-size: 1em;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="article-container">
        <h1><?php echo htmlspecialchars($article['Description']); ?></h1>
        <img src="<?php echo htmlspecialchars($article['Photo']); ?>" alt="<?php echo htmlspecialchars($article['description']); ?>">
        <div class="prix">Prix: €<?php echo htmlspecialchars($article['Prix']); ?></div>
        <div class="vendeur">Vendeur: <?php echo htmlspecialchars($article['IDvendeur']); ?></div>
        <div class="categorie">Catégorie: <?php echo htmlspecialchars($article['Catégorie']); ?></div>
        <div class="description"><?php echo nl2br(htmlspecialchars($article['Description'])); ?></div>
        <div class="buttons">
            <button onclick="ajouterAuPanier(<?php echo $article['ID_objet']; ?>)">Ajouter au panier</button>
            <button onclick="payerEnUnClic(<?php echo $article['ID_objet']; ?>)">Payer en un clic !</button>
        </div>
    </div>

    <script>
        function ajouterAuPanier(id) {
            // Fonction JavaScript pour ajouter au panier
            alert("Article " + id + " ajouté au panier!");
        }

        function payerEnUnClic(id) {
            // Fonction JavaScript pour payer en un clic
            alert("Paiement en 1 clic pour l'article " + id + "!");
        }
    </script>
</body>
</html>
