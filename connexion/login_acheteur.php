<?php
session_start();
function redirectToUrl(string $url): never //Fonction pour retourner sur la page index
{
    header("Location: {$url}");
    exit();
}
$login = isset($_POST["identifiant"])? $_POST["identifiant"] : "";  //Vérifie que les logins et le mdp ne soient pas vide
$pass = isset($_POST["passw"])? $_POST["passw"] : "";

//identifier le nom de base de données
$database = "agora";
//connectez-vous dans votre BDD
//Rappel : votre serveur = localhost | votre login = root | votre mot de pass = '' (rien)
$db_handle = mysqli_connect('localhost', 'root', '' );
$db_found = mysqli_select_db($db_handle, $database);
$sql = "";

if ($db_found) {
	if($login != "" AND $pass != ""){
		$sql = "SELECT * FROM acheteur WHERE Email = '$login' AND Password = '$pass'" ;
		$result = mysqli_query($db_handle, $sql);
		while ($data = mysqli_fetch_assoc($result)) {
				if ( $data['Email'] == $login && $data['Password'] == $pass ) {  //Deuxième vérification
					$_SESSION['LOGGED_USER'] = $data['Pseudo']; //Permet de prendre le nom de l'utilisateur
					$_SESSION['ID_ACHETEUR'] = $data['ID_acheteur'];
				}
 			}
 		}
 	}
else {
 	echo "Database not found";
 }
redirectToUrl('../compte.php');   //Redirige automatiquement vers la page index
?>