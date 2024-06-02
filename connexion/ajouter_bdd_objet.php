<?php
session_start();
$_SESSION['Nom'] = '';
$_SESSION['Description'] = '';
$_SESSION['Prix'] = '';
//J'ai rajouté Login et REMPLIR
$_SESSION['Type'] = '';
$_SESSION['Categorie'] = '';
$_SESSION['Photo'] = '';

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
	if($nom == "" OR $description == "" OR $prix == "" OR $type == "" OR $categorie == "" OR $photo == ""){
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
	if ($categorie == "") {
		$_SESSION['Categorie']= 'Il faut remplir la categorie';
	}
	if ($photo == "") {
		$_SESSION['Photo']= 'Il faut remplir la photo';
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
      	$sql1 = "SELECT * FROM objet WHERE Nom = '$nom' AND Description = '$description' AND Prix = '$prix' AND Type = '$type' AND Categorie = '$categorie' AND Photo = '$photo'"; ;
		$result1 = mysqli_query($db_handle, $sql1);
		$rows = mysqli_num_rows($result1);
		if($rows == 1){
			echo "Le compte existe déjà";
			$_SESSION['REMPLIR'] = '';

			}
		else if ($rows ==0){
			if($_SESSION['ID_VENDEUR'] !=''){
				$id = $_SESSION['ID_VENDEUR'];
			$sql = "INSERT INTO objet (Nom,Description,Prix,Type,Categorie,Photo,IDvendeur) VALUES ('$nom','$description','$prix','$type','$categorie','$photo','$id')";
			$result = mysqli_query($db_handle, $sql);
			} else {
				$sql = "INSERT INTO objet (Nom,Description,Prix,Type,Categorie,Photo) VALUES ('$nom','$description','$prix','$type','$categorie','$photo')";
			$result = mysqli_query($db_handle, $sql);
			}
			}
		}
else {
	echo "Database not found";
}
redirectToUrl('ajouter_objet.php');
}

?>