<?php 
session_start(); 
//session_destroy();
//identifier le nom de base de données
$database = "agora";
//connectez-vous dans votre BDD
//Rappel : votre serveur = localhost | votre login = root | votre mot de pass = '' (rien)
$db_handle = mysqli_connect('localhost', 'root', '' );
$db_found = mysqli_select_db($db_handle, $database);
if ($db_found) {
	$sql = "SELECT * FROM objet" ;
	$result = mysqli_query($db_handle, $sql);
}?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset=utf-8 />
		<title>Meilleure offre PJ WEB2024</title>
	</head>
	<body>
		
		<form action="Offre_BDD.php" method="post">
			<table>
				<tr>
					<td><?php
					while ($data = mysqli_fetch_assoc($result)) {
						echo $data['Nom'];
						$_SESSION['Objet'] = $data['Nom'];
						$_SESSION['IDobjet'] = $data['ID_objet'];
					}
					?></td>
				</tr>
				<tr>
					<td>Votre offre :</td>
					<td><input type = "number" name="offre"></td>
				</tr>

			</table>
			<button type="submit" name="Valider">Valider l'offre</button>
		</form>
	<?php if (isset($_SESSION['Confirmation'])) : ?>
		Confirmation de l'offre pour l'article <?php echo $_SESSION['Objet']; ?>
	<?php endif; ?>
	</body>
</html>
