<?php
	include 'randoShowOneFunction.php';
	include '../layout/layoutStart.php';

?>

		<a href="http://localhost/dolibarr/htdocs/custom/rando/reboot/test1/randoCreate.php">Lien vers randoCreate</a></br>
		<a href="http://localhost/dolibarr/htdocs/custom/rando/reboot/test1/randoList.php">Lien vers randoList</a>
		<h4>randoShowOne</h4>
		<form action="http://localhost/dolibarr/htdocs/custom/rando/reboot/test1/randoUpdateFunction.php" method="post">
			<input type="hidden" name="id" value="1">
			<input type="hidden" name="action" value="update">
			<table>
				<tr>
					<td><label for="name">Nom : </label></td>
					<td><input type="text" id="name" name="name" value="<?php echo $donnees['name']; ?>"></td>
				</tr>
				<tr>
					<td><label for="distance">Distance : </label></td>
					<td><input type="text" id="distance" name="distance" value="<?php echo $donnees['distance']; ?>"></td>
				</tr>
			</table>
			<button type="submit">Valider</button>		
		</form>

<?php 
	include '../layout/layoutEnd.php';
?>

