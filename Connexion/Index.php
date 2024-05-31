<?php 
session_start(); ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset=utf-8 />
		<title>Connexion PJ WEB2024</title>
	</head>
	<body>
		
		<form action="Login.php" method="post">
			<table>
				<tr>
					<td>Login :</td>
					<td><input type="text" name="identifiant"></td>
				</tr>
				<tr>
					<td>Password :</td>
					<td><input type = "password" name="passw"></td>
				</tr>

			</table>
			<button type="submit" name="Valider">Connexion</button>
		</form>
		<form action="Logout.php">
			<button type="submit">Déconnexion</button>
		</form>
		<a href="Creation.php">Pas de compte ? Créer en un en cliquant ici</a></br>
		<a href="Admin_Vendeur_Connexion.php">Admin ou vendeur ?</a>
	<?php if (isset($_SESSION['LOGGED_USER'])) : ?>
		Connexion okay. <?php echo $_SESSION['LOGGED_USER']; ?>
	<?php endif; ?>
	</body>
</html>
