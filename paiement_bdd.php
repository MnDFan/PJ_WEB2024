<?php
session_start();
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

	$id = $_SESSION['ID_ACHETEUR'];
	$typecarte = isset($_POST["type_carte"])? $_POST["type_carte"] : "";
	$numcarte = isset($_POST["numcarte"])? $_POST["numcarte"] : "";
	$nomcarte = isset($_POST["nomcarte"])? $_POST["nomcarte"] : "";
	$expirecarte = isset($_POST["expirationcarte"])? $_POST["expirationcarte"] : "";
	$cvv = isset($_POST["cvv"])? $_POST["cvv"] : "";
	if( $typecarte == "" OR $numcarte == "" OR $nomcarte == "" OR $expirecarte == "" OR $cvv == ""){
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
   redirectToUrl('paiement.php');

} else {

	//identifier le nom de base de données
$database = "agora";
//connectez-vous dans votre BDD
//Rappel : votre serveur = localhost | votre login = root | votre mot de pass = '' (rien)
$db_handle = mysqli_connect('localhost', 'root', '' );
$db_found = mysqli_select_db($db_handle, $database);
$sql1 = "";
$sql = "";

if ($db_found) {
      	$sql1 = "SELECT * FROM acheteur WHERE ID_acheteur = '$id'" ;
		$result1 = mysqli_query($db_handle, $sql1);
		while ($data = mysqli_fetch_assoc($result1)) {
		if ($typecarte != $data['Type_carte'] OR $numcarte != $data['NumCarte'] OR $nomcarte != $data['NomCarte'] OR $expirecarte != $data['DateExpiration'] OR $cvv != $data['CodeSecu']){
		if ($typecarte != $data['Type_carte']) {
		$_SESSION['Typecarte']= "Mauvais type de carte";
	}
	if ($numcarte != $data['NumCarte']) {
		$_SESSION['Numcarte']= 'Mauvais numero de la carte';
	}
	if ($nomcarte != $data['NomCarte']) {
		$_SESSION['Nomcarte']= 'Mauvais nom de la carte';
	}
	if ($expirecarte != $data['DateExpiration']) {
		$_SESSION['Expirecarte']= "Mauvaise date d'expiration";
	}
	if ($cvv != $data['CodeSecu']) {
		$_SESSION['CVV']= 'Mauvais CVV';
}
	redirectToUrl('paiement.php');
} else {
		$sql = "DELETE FROM panier WHERE ID_acheteur = '$id';" ;
		$result = mysqli_query($db_handle, $sql);
		$_SESSION['REMPLIR'] = 'ok';
	}
}
} else {
	echo "Database not found";
}
redirectToUrl('paiement.php');
}

?>