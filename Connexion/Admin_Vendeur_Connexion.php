<?php 
session_start(); ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset=utf-8 />
		<title>Connexion PJ WEB2024</title>
	</head>
	<body>
		
		<form action="Login_AdminVendeur.php" method="post">
			<table>
				<tr>
					<td>Login :</td>
					<td><input type="text" name="identifiant"></td>
				</tr>
				<tr>
					<td>Password :</td>
					<td><input type = "password" name="passw"></td>
				</tr>
				<tr>
					<td>Type de compte :</td>
					<td><input type="radio" name="choice" value="1">Admin<br>
					<input type="radio" name="choice" value="2">Vendeur<br>
				</tr>
			</table>
			<button type="submit" name="Valider">Valider</button>
		</form>
		<form action="Logout.php">
			<button type="submit">Déconnexion</button>
		</form>
		<a href="Index.php">acheteur ?</a>
	</body>
</html>
