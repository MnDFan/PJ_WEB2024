<?php
session_start();
$_SESSION['Erreurmail'] = '';
$_SESSION['Pseudo'] = '';
//J'ai rajouté Login et REMPLIR
$_SESSION['Mail'] = '';

function redirectToUrl(string $url): never //Fonction pour retourner sur la page index
{
    header("Location: {$url}");
    exit();
}
  //Vérifie que les logins et le mdp ne soient pas vide


    $mail = isset($_POST["email"])? $_POST["email"] : "";  //Vérifier que tout est remplie
    $pseudo = isset($_POST["pseudo"])? $_POST["pseudo"] : "";
    if( $mail == "" OR $pseudo == ""){
        if ($mail == "") {
            $_SESSION['Mail']= "Il faut remplir l'email";
        }
        else {
            if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $_SESSION['Erreurmail'] = 'Il vous faut un e-mail valide';
            }
        }
    if ($pseudo == "") {
        $_SESSION['Pseudo']= 'Il faut remplir le pseudo';
    }
   redirectToUrl('../compte.php');

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
    if($pseudo != ""){
        $sql1 = "SELECT * FROM vendeur WHERE Email = '$mail' AND Login = '$pseudo'"; ;
        $result1 = mysqli_query($db_handle, $sql1);
        $rows = mysqli_num_rows($result1);
        if($rows == 1){
            $sql = "DELETE FROM vendeur WHERE Email = '$mail' AND Login = '$pseudo'";
            $result = mysqli_query($db_handle, $sql);
            }
        else if ($rows ==0){
            echo "Le compte n'existe pas";
            $_SESSION['REMPLIR'] = '';
            
            }
        }
    }
else {
    echo "Database not found";
}
redirectToUrl('supprimer_vendeur.php');
}

?>