<?php
	include '../layout/layoutStart.php';
?>


			<a href="http://localhost/dolibarr/htdocs/custom/rando/reboot/test1/randoList.php">Lien vers randoList</a>
			<h4>randoCreate</h4>
			<form action="http://localhost/dolibarr/htdocs/custom/rando/reboot/test1/randoCreateFunction.php" method="post">
				<input type="hidden" name="id" value="1">
				<input type="hidden" name="action" value="create">
				<table>
					<tr>
						<td><label for="name">Nom : </label></td>
						<td><input type="text" id="name" name="name"></td>
					</tr>
					<tr>
						<td><label for="distance">Distance : </label></td>
						<td><input type="text" id="distance" name="distance"></td>
					</tr>
				<!--<tr>
						<td><label for="difficulte">Difficulte : </label></td>
						<td>
							<select id="difficulte" name="difficulte">
								<option value="facile">Facile</option>
								<option value="moyen">Moyen</option>
								<option value="difficile">Difficile</option>
							</select>
						</td>
					</tr>-->
				</table>
				<button type="submit">Valider</button>		
			</form>

		
		
		
			

			<h4>Card Show</h4>
			<table>
				<?php 
					print "
							<tr>
								<td>Nom</td>
								<td><p>".$rando['nom']."</p></td>
							</tr>
							<tr>
								<td>Distance</td>
								<td><p>".$rando['distance']."</p></td>
							</tr>
							<tr>
								<td>Difficulte</td>
								<td><p>".$rando['difficulte']."</p></td>
							</tr>
					";
				?>
			</table>
			<a href="http://localhost/dolibarr/htdocs/custom/rando/reboot/card.php?id=1&action=modify">Modifier</a>
			<a href="http://localhost/dolibarr/htdocs/custom/rando/reboot/card.php?id=1&action=delete">Supprimer</a>

		
	<?php 
	include '../layout/layoutEnd.php';
	?>
	