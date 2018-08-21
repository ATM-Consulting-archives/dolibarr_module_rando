<?php
	include 'randoListFunction.php';
	include '../layout/layoutStart.php';
?>

	<a href="http://localhost/dolibarr/htdocs/custom/rando/reboot/test1/randoCreate.php">Lien vers randoCreate</a>

	<table>
		<tr>
			<td><h4>NOM</h4></td>
			<td><h4>DISTANCE</h4></td>
			<td><h4>DIFFICULTE</h4></td>
		</tr>
    	
		<?php 
		while ($donnees = $reponse->fetch())// On affiche chaque entrée une à une
		{
		
		?><!--  on ferme le php-->
	
	
			<tr>
		    	<td><?php echo $donnees['name']; ?></td>
		    	<td><?php echo $donnees['distance']; ?></td>
			</tr>
  
		<?php
		}//fin de la boucle while
		?>

	</table>

	<?php 
	$reponse->closeCursor(); // Termine le traitement de la requête
		
	include '../layout/layoutEnd.php';



