<?php
session_start();
$_SESSION['Erreurmail'] = '';

function redirectToUrl(string $url): never //Fonction pour retourner sur la page index
{
    header("Location: {$url}");
    exit();
}
  //Vérifie que les logins et le mdp ne soient pas vide

if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    	$_SESSION['Erreurmail'] = 'Il vous faut un e-mail valide';
    	redirectToUrl('Creation.php');
} else {
	$login = isset($_POST["email"])? $_POST["email"] : "";  //Vérifier que tout est remplie
	$pass = isset($_POST["passw"])? $_POST["passw"] : "";
	$nom = isset($_POST["nom"])? $_POST["nom"] : "";
	$prenom = isset($_POST["prenom"])? $_POST["prenom"] : "";
	$adresse1 = isset($_POST["adresse1"])? $_POST["adresse1"] : "";
	$adresse2 = isset($_POST["adresse2"])? $_POST["adresse2"] : "";
	$ville = isset($_POST["ville"])? $_POST["ville"] : "";
	$postal = isset($_POST["postal"])? $_POST["postal"] : "";
	$pays = isset($_POST["pays"])? $_POST["pays"] : "";
	$tel = isset($_POST["telephone"])? $_POST["telephone"] : "";

	//identifier le nom de base de données
$database = "agora";
//connectez-vous dans votre BDD
//Rappel : votre serveur = localhost | votre login = root | votre mot de pass = '' (rien)
$db_handle = mysqli_connect('localhost', 'root', '' );
$db_found = mysqli_select_db($db_handle, $database);
$sql1 = "";
$sql = "";

if ($db_found) {
	if($login != "" AND $pass != ""){
      	$sql1 = "SELECT * FROM acheteur WHERE Email = '$login' AND Password = '$pass'" ;
		$result1 = mysqli_query($db_handle, $sql1);
		$rows = mysqli_num_rows($result1);
		if($rows == 1){
			echo "Le compte existe déjà";
			}
		else if ($rows ==0){
			$sql = "INSERT INTO acheteur (Nom,Prenom,AdresseLigne1,AdresseLigne2,Ville,Postal,Pays,NumTel,Email,Password) VALUES ( '$nom', '$prenom', '$adresse1', '$adresse2', '$ville', '$postal', '$pays', '$tel', '$login', '$pass');";
			$result = mysqli_query($db_handle, $sql);
			
			}
		}
	}
else {
	echo "Database not found";
}
redirectToUrl('Creation.php');
}

?>