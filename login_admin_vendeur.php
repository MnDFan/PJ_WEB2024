<?php
session_start();
$_SESSION['Background'] = '';
$_SESSION['Photo'] = '';
function redirectToUrl(string $url): never //Fonction pour retourner sur la page index
{
    header("Location: {$url}");
    exit();
}
$login = isset($_POST["identifiant"])? $_POST["identifiant"] : "";  //Vérifie que les logins et le mdp ne soient pas vide
$pass = isset($_POST["passw"])? $_POST["passw"] : "";
$choice = isset($_POST["choice"])? $_POST["choice"] : "";

if (empty($choice)) {
  $choice = 0;
}
$choice = (int)$choice;

//identifier le nom de base de données
$database = "agora";
//connectez-vous dans votre BDD
//Rappel : votre serveur = localhost | votre login = root | votre mot de pass = '' (rien)
$db_handle = mysqli_connect('localhost', 'root', '' );
$db_found = mysqli_select_db($db_handle, $database);
$sql = "";
switch ($choice) {
    		case 1:
      			$sql = "SELECT * FROM administrateur WHERE Login = '$login' AND Password = '$pass'" ;
      			break;
    		case 2:
     	 		$sql = "SELECT * FROM vendeur WHERE Login = '$login' AND Password = '$pass'" ;
      			break;
    		default:
      			$sql = "SELECT * FROM vendeur WHERE Login = '$login' AND Password = '$pass'" ;
      			break;
  		}

if ($db_found) {
	if($login != "" AND $pass != ""){
		$result = mysqli_query($db_handle, $sql);
		while ($data = mysqli_fetch_assoc($result)) {
				if ( $data['Login'] == $login && $data['Password'] == $pass ) {  //Deuxième vérification
					if($choice == 1){
						$_SESSION['LOGGED_ADMIN'] = $data['Login']; //Permet de prendre le nom de l'utilisateur
						$_SESSION['ID_VENDEUR'] = $data['ID_admin'];
					} else {
						$_SESSION['LOGGED_VENDEUR'] = $data['Login'];
						$_SESSION['ID_VENDEUR'] = $data['ID_vendeur'];
						$_SESSION['Background'] = $data['Fond'];
						$_SESSION['Photo'] = $data['Photo'];
					}
				}
 			}
 		}
 	}
else {
 	echo "Database not found";
 }
redirectToUrl('../compte.php');   //Redirige automatiquement vers la page index
?>