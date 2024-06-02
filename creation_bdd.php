<?php
session_start();
$_SESSION['Erreurmail'] = '';
$_SESSION['Nom'] = '';
$_SESSION['Prenom'] = '';
$_SESSION['Pseudo'] = '';
$_SESSION['Adresse1'] = '';
$_SESSION['Ville'] = '';
$_SESSION['Postal'] = '';
$_SESSION['Pays'] = '';
$_SESSION['Tel'] = '';
$_SESSION['Login'] = '';
$_SESSION['Numcarte'] = '';
$_SESSION['Typecarte'] = '';
$_SESSION['Nomcarte'] = '';
$_SESSION['Expirecarte'] = '';
$_SESSION['CVV'] = '';

$_SESSION['REMPLIR'] = '';

function redirectToUrl(string $url): never //Fonction pour retourner sur la page index
{
    header("Location: {$url}");
    exit();
}
  //Vérifie que les logins et le mdp ne soient pas vide


	$login = isset($_POST["email"])? $_POST["email"] : "";  //Vérifier que tout est remplie
	$pseudo = isset($_POST["pseudo"])? $_POST["pseudo"] : "";
	$pass = isset($_POST["passw"])? $_POST["passw"] : "";
	$nom = isset($_POST["nom"])? $_POST["nom"] : "";
	$prenom = isset($_POST["prenom"])? $_POST["prenom"] : "";
	$adresse1 = isset($_POST["adresse1"])? $_POST["adresse1"] : "";
	$adresse2 = isset($_POST["adresse2"])? $_POST["adresse2"] : "";
	$ville = isset($_POST["ville"])? $_POST["ville"] : "";
	$postal = isset($_POST["postal"])? $_POST["postal"] : "";
	$pays = isset($_POST["pays"])? $_POST["pays"] : "";
	$tel = isset($_POST["telephone"])? $_POST["telephone"] : "";
	$typecarte = isset($_POST["type_carte"])? $_POST["type_carte"] : "";
	$numcarte = isset($_POST["numcarte"])? $_POST["numcarte"] : "";
	$nomcarte = isset($_POST["nomcarte"])? $_POST["nomcarte"] : "";
	$expirecarte = isset($_POST["expirationcarte"])? $_POST["expirationcarte"] : "";
	$cvv = isset($_POST["cvv"])? $_POST["cvv"] : "";
	if($pass == "" OR $login == "" OR $nom == "" OR $prenom == "" OR $adresse1 == "" OR $adresse2 == "" OR $ville == "" OR $postal == "" OR $pays == "" OR $tel == "" OR $typecarte == "" OR $numcarte == "" OR $nomcarte == "" OR $expirecarte == "" OR $cvv == ""){
		if ($login == "") {
			$_SESSION['Login']= "Il faut remplir l'email";
		}
		else {
			if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    		$_SESSION['Erreurmail'] = 'Il vous faut un e-mail valide';
			}
		}
	if ($pseudo == "") {
		$_SESSION['Pseudo']= 'Il faut remplir le pseudo';
	}
	if ($pass == "") {
		$_SESSION['Password']= 'Il faut remplir le mot de passe';
	}
	if ($nom == "") {
		$_SESSION['Nom']= 'Il faut remplir le nom';
	}
	if ($prenom == "") {
		$_SESSION['Prenom']= 'Il faut remplir le prenom';
	}
	if ($adresse1 == "") {
		$_SESSION['Adresse1']= "Il faut remplir l'adresse";
	}
	if ($ville == "") {
		$_SESSION['Ville']= 'Il faut remplir la ville';
	}
	if ($postal == "") {
		$_SESSION['Postal']= 'Il faut remplir le code postal';
	}
	if ($pays == "") {
		$_SESSION['Pays']= 'Il faut remplir le pays';
	}
	if ($tel == "") {
		$_SESSION['Tel']= 'Il faut remplir le tel';
	}
	if ($typecarte == "") {
		$_SESSION['Typecarte']= "Il faut remplir le type de carte";
	}
	if ($numcarte == "") {
		$_SESSION['Numcarte']= 'Il faut remplir le numero de la carte';
	}
	if ($nomcarte == "") {
		$_SESSION['Nomcarte']= 'Il faut remplir le nom de la carte';
	}
	if ($expirecarte == "") {
		$_SESSION['Expirecarte']= "Il faut remplir la date d'expiration";
	}
	if ($cvv == "") {
		$_SESSION['CVV']= 'Il faut remplir le CVV';
	}
	if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) AND $login != "") {
    	$_SESSION['Erreurmail'] = 'Il vous faut un e-mail valide';
   }
   redirectToUrl('creation.php');

} else {
	$_SESSION['REMPLIR'] = 'ok';  //Ca permet de vérifier que tout est rempli

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
			$sql = "INSERT INTO acheteur (Pseudo,Nom,Prenom,AdresseLigne1,AdresseLigne2,Ville,Postal,Pays,NumTel,Email,Password,Type_carte,NumCarte,NomCarte,DateExpiration,CodeSecu) VALUES ( '$pseudo,'$nom', '$prenom', '$adresse1', '$adresse2', '$ville', '$postal', '$pays', '$tel', '$login', '$pass','$typecarte','$numcarte','$nomcarte','$expirecarte','$cvv');";
			$result = mysqli_query($db_handle, $sql);
			
			}
		}
	}
else {
	echo "Database not found";
}
redirectToUrl('creation.php');
}

?>