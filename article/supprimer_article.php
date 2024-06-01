<?php
session_start();
function redirectToUrl(string $url): never //Fonction pour retourner sur la page index
{
    header("Location: {$url}");
    exit();
}

$id_objet = isset($_POST["supprimer"])? $_POST["supprimer"] : "";
$id_objet = (int)$id_objet;

//identifier le nom de base de données
$database = "agora";
//connectez-vous dans votre BDD
//Rappel : votre serveur = localhost | votre login = root | votre mot de pass = '' (rien)
$db_handle = mysqli_connect('localhost', 'root', '' );
$db_found = mysqli_select_db($db_handle, $database);
if ($db_found) {
		$sql = "DELETE FROM panier WHERE NumPanier = '$id_objet'" ;
		$result = mysqli_query($db_handle, $sql);
 		}
else {
 	echo "Database not found";
 }
redirectToUrl('../panier.php');   //Redirige automatiquement vers la page index
?>