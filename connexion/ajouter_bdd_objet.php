<?php
session_start();
$_SESSION['Nom'] = '';
$_SESSION['Description'] = '';
$_SESSION['Prix'] = '';
$_SESSION['Type'] = '';
$_SESSION['Categorie'] = '';
$_SESSION['Photo_objet'] = '';
$_SESSION['Date_debut'] = '';
$_SESSION['Date_fin'] = '';

function redirectToUrl(string $url): never //Fonction pour retourner sur la page index
{
    header("Location: {$url}");
    exit();
}
  //Vérifie que les logins et le mdp ne soient pas vide


	$nom = isset($_POST["nom"])? $_POST["nom"] : "";  //Vérifier que tout est remplie
	$description = isset($_POST["description"])? $_POST["description"] : "";
	$prix = isset($_POST["prix"])? $_POST["prix"] : "";
	$type = isset($_POST["type"])? $_POST["type"] : "";
	$categorie = isset($_POST["categorie"])? $_POST["categorie"] : "";
	$photo = isset($_POST["photo"])? $_POST["photo"] : "";
	$date_debut = isset($_POST["date_debut"])? $_POST["date_debut"] : "";
	$date_fin = isset($_POST["date_fin"])? $_POST["date_fin"] : "";
	if($nom == "" OR $description == "" OR $prix == "" OR $type == "" OR $categorie == "" OR $photo == "" ){
		if ($nom == "") {
			$_SESSION['Nom']= "Il faut remplir le nom";
		}
	if ($description == "") {
		$_SESSION['Description']= 'Il faut remplir la description';
	}
	if ($prix == "") {
		$_SESSION['Prix']= 'Il faut remplir le prix';
	}
	if ($type == "") {
		$_SESSION['Type']= 'Il faut remplir le type';
	}
	if($type == "Meilleure offre") {
	if ($date_debut == "") {
		$_SESSION['Date_debut']= 'Il faut remplir la date de debut';
	}
	if ($date_fin == "") {
		$_SESSION['Date_fin']= 'Il faut remplir la date de fin';
	}
}
	if ($categorie == "") {
		$_SESSION['Categorie']= 'Il faut remplir la categorie';
	}
	
	if ($photo == "") {
		$_SESSION['Photo_objet']= 'Il faut remplir la photo';
	}
	
   redirectToUrl('ajouter_objet.php');

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
			if($_SESSION['ID_VENDEUR'] ==''){
				$id = $_SESSION['ID_ADMIN'];
			$sql = "INSERT INTO objet (Nom,Description,Prix,Type,Categorie,Photo,IDadmin,Date_debut,Date_fin) VALUES ('$nom','$description','$prix','$type','$categorie','$photo','$id','$date_debut','$date_fin')";
			$result = mysqli_query($db_handle, $sql);
			} else{
				$id = $_SESSION['ID_VENDEUR'];
			$sql = "INSERT INTO objet (Nom,Description,Prix,Type,Categorie,Photo,IDvendeur,Date_debut,Date_fin) VALUES ('$nom','$description','$prix','$type','$categorie','$photo','$id','$date_debut','$date_fin')";
			$result = mysqli_query($db_handle, $sql);
			}
		}else {
	echo "Database not found";
}
redirectToUrl('ajouter_objet.php');
}

?>