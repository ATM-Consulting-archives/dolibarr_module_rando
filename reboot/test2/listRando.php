<?php
include 'manage.php';
include '../layout/layoutStart.php';

fetchAllRando();
$reponse = fetchAllRando($req);
?>

<table>
	<tr>
		<td><h4>NOM</h4></td>
		<td><h4>DISTANCE</h4></td>
		<td><h4>DIFFICULTE</h4></td>
	</tr>
    	
		<?php
		while ($donnees = $reponse->fetch()) // On affiche chaque entrée une à une
		{

			?>
	<!--  on ferme le php-->

	<tr>
		<td><a
			href="http://localhost/dolibarr/htdocs/custom/rando/reboot/test2/randoCard.php?id=<?php echo $donnees['id']; ?>">
			    		<?php echo $donnees['name']; ?>
			    	</a></td>

		<td><?php echo $donnees['distance']; ?></td>
	</tr>
  			
		<?php
		} // fin de la boucle while
		?>

	</table>

<?php
$reponse->closeCursor(); // Termine le traitement de la requête

include '../layout/layoutEnd.php';


