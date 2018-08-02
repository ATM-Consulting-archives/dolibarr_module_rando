<!DOCTYPE html>
<html>
	<head>
	</head>
	<body>
		<div class="container">
			<a href="http://localhost/dolibarr/htdocs/custom/rando/reboot/list.php">Lien vers liste</a>
			<h4>Card Edit</h4>
			<form action="http://localhost/dolibarr/htdocs/custom/rando/reboot/card.php?id=1" method="get">
				<input type="hidden" name="id" value="1">
				<input type="hidden" name="action" value="update">
				<table>
					<tr>
						<td><label for="nom">Nom : </label></td>
						<td><input type="text" id="nom" name="nom"></td>
					</tr>
					<tr>
						<td><label for="distance">Distance : </label></td>
						<td><input type="text" id="distance" name="distance"></td>
					</tr>
					<tr>
						<td><label for="difficulte">Difficulte : </label></td>
						<td>
							<select id="difficulte" name="difficulte">
								<option value="facile">Facile</option>
								<option value="moyen">Moyen</option>
								<option value="difficile">Difficile</option>
							</select>
						</td>
					</tr>
				</table>
				<button type="submit">Valider</button>		
			</form>
		</div><!-- fin de container -->
			
		<div class="container">
			<h4>Card Show</h4>
			<table>
				<tr>
					<td>Nom</td>
					<td><p>Name Rando</p></td>
				</tr>
				<tr>
					<td>Distance</td>
					<td><p>15 km</p></td>
				</tr>
				<tr>
					<td>Difficulte</td>
					<td><p>Diffficile</p></td>
				</tr>
			</table>
			<a href="http://localhost/dolibarr/htdocs/custom/rando/reboot/card.php?id=1&action=modify">Modifier</a>
			<a href="http://localhost/dolibarr/htdocs/custom/rando/reboot/card.php?id=1&action=delete">Supprimer</a>
		</div><!-- fin de container -->
		
	</body>
</html>