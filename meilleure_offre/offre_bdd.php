<?php
session_start();
$_SESSION['Confirmation'] = 0;
function redirectToUrl(string $url): never //Fonction pour retourner sur la page index
{
    header("Location: {$url}");
    exit();
}
$nomobjet = $_SESSION['Objet'];
$IDobjet = $_SESSION['IDobjet'];
$user_id = $_SESSION['ID_ACHETEUR'];
//$nomacheteur = 
$offre = isset($_POST["offre"])? $_POST["offre"] : "";  //Vérifie que les logins et le mdp ne soient pas vide
$offre = (int)$offre;

//identifier le nom de base de données
$database = "agora";
//connectez-vous dans votre BDD
//Rappel : votre serveur = localhost | votre login = root | votre mot de pass = '' (rien)
$db_handle = mysqli_connect('localhost', 'root', '' );
$db_found = mysqli_select_db($db_handle, $database);
if ($db_found) {
		$sql = "INSERT INTO meilleureoffre (NomObjet,PrixPropose,ID_objet) VALUES ('$nomobjet','$offre','$IDobjet');" ;
		//$sql = "INSERT INTO meilleureoffre (NomObjet,NomAcheteur) VALUES ('$nomobjet','$nomacheteur');" ;
		$result = mysqli_query($db_handle, $sql);
		$_SESSION['Confirmation'] = 1;
		$sql1 = "INSERT INTO panier (ID_acheteur,ID_objet) VALUES ('$user_id','$IDobjet');" ;
		$result1 = mysqli_query($db_handle, $sql1);
		$_SESSION['Confirmation_panier'] = 1;
 		}
else {
 	echo "Database not found";
 }
redirectToUrl('../article/article.php');   //Redirige automatiquement vers la page index
?>