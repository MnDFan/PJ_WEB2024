<!DOCTYPE html>
<html>
	<head>
		<meta charset=utf-8 />
		<title>Création d'un compte PJ WEB2024</title>
	</head>
	<body>
		
		<form action="Creation_bdd.php" method="post">
			<p>Création d'un compte</p>
			<table>
				<tr>
					<td>Nom :</td>
					<td><input type = "text" name="nom"></td>
				</tr>
				<tr>
					<td>Prénom :</td>
					<td><input type = "text" name="prenom"></td>
				</tr>
				<tr>
					<td>E-mail :</td>
					<td><input type="text" name="email"></td>
				</tr>
				<tr>
					<td>Password :</td>
					<td><input type = "password" name="passw"></td>
				</tr>
				<tr>
					<td>Adresse Ligne 1 :</td>
					<td><input type = "text" name="adresse1"></td>
				</tr>
				<tr>
					<td>Adresse Ligne 2 :</td>
					<td><input type = "text" name="adresse2"></td>
				</tr>
				<tr>
					<td>Ville :</td>
					<td><input type = "text" name="ville"></td>
				</tr>
				<tr>
					<td>Code Postal :</td>
					<td><input type = "number" name="postal"></td>
				</tr>
				<tr>
					<td>Pays :</td>
					<td><input type = "text" name="pays"></td>
				</tr>
				<tr>
					<td>Numéro de téléphone :</td>
					<td><input type = "tel" name="telephone"></td>
				</tr>
			</table>
			<button type="submit" name="Valider">Valider</button>
		</form>

	</body>
</html>
