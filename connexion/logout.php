<?php
session_start();
function redirectToUrl(string $url): never //Fonction pour retourner sur la page index
{
    header("Location: {$url}");
    exit();
}
session_destroy();
redirectToUrl('../Compte.php');   //Redirige automatiquement vers la page index
?>