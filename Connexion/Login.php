<?php
session_start();
function redirectToUrl(string $url): never //Fonction pour retourner sur la page index
{
    header("Location: {$url}");
    exit();
}
$login = isset($_POST["identifiant"])? $_POST["identifiant"] : "";  //Vérifie que les logins et le mdp ne soient pas vide
$pass = isset($_POST["passw"])? $_POST["passw"] : "";

$users = [   //Liste des comptes( remplacer par la BDD plus tard)
	[   'identifiant' => 'toto',
		'passw' => 'totomdp'
	]
];
foreach ($users as $user) {  //On regard chaque compte et voir si ils sont présent dans la base
	if ( $user['identifiant'] == $login && $user['passw'] == $pass ) {
		$_SESSION['LOGGED_USER'] = 'toto'; //Permet de prendre le nom de l'utilisateur
		
	}
}
redirectToUrl('Index.php');   //Redirige automatiquement vers la page index
?>