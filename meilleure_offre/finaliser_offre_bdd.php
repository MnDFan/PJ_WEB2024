<?php
session_start();
function redirectToUrl(string $url): never //Fonction pour retourner sur la page index
{
    header("Location: {$url}");
    exit();
}
$premier_prix = 0;
$second_prix = 0;
$id = $_SESSION['ID'];
$id_gagnant = 0;
$_SESSION['Gagnant'] = 0;
//identifier le nom de base de données
$database = "agora";
//connectez-vous dans votre BDD
//Rappel : votre serveur = localhost | votre login = root | votre mot de pass = '' (rien)
$db_handle = mysqli_connect('localhost', 'root', '' );
$db_found = mysqli_select_db($db_handle, $database);
if ($db_found) {
		$sql = "SELECT * FROM meilleureoffre WHERE ID_objet = '$id';" ;
		$result = mysqli_query($db_handle, $sql);
		while ($data = mysqli_fetch_assoc($result)) {
			if($premier_prix < $data['PrixPropose']){
				$second_prix = $premier_prix;
				$premier_prix = $data['PrixPropose'];
				$id_gagnant = $data['ID_acheteur'];


			}
 		}
 		$_SESSION['Gagnant'] = $id_gagnant;
}else {
 	echo "Database not found";
 }
redirectToUrl('../article/article.php');   //Redirige automatiquement vers la page index
?>