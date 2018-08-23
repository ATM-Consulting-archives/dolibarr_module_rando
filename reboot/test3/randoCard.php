<?php
	include '../connect2.php';
	include 'Rando.php';
	include '../layout/layoutStart.php';
	
	
	//je determine si j'ai des valeurs d'entrée par un id et j'affecte cette valeur à ma variable pour déterminer la suite
	$id_rando = $_POST['id_rando'];

		//je verifie si j'ai une valeur d'id
	if (empty ($id_rando)) {
		$id_rando = $_GET['id_rando'];
	}

	if (!empty ($id_rando) ){
		$randos = new Rando();
		$donnees = $randos->fetchOneRando($randos, $id_rando);
	}

	
	//je determine si j'ai des actions à faire pour une rando
	$action = $_POST['action'];
	$action_wp = $_POST['action_wp'];

	if ($action === '') {
		$action = 'createRando';
	} 
	
	if ($action == 'createRando') {
		createRando($_POST['name'], $_POST['distance'], $_POST['difficulte']);
		header('Location: randoCard.php');
		exit;
	}
	
	if ($action == 'updateRando') {
		updateRando($_POST['id_rando'], $_POST['name'], $_POST['distance'], $_POST['difficulte']);
		header('Location: randoCard.php');
		exit;
	}
	
	if ($action == 'deleteRando') {
		deleteRando($_POST['id_rando']);
		header('Location: randoCard.php');
		exit;
	}
	if ($id_rando != '') {
		$action = 'updateRando';
	}


	
	?>
	<table>
		<form action="http://localhost/dolibarr/htdocs/custom/rando/reboot/test3/randoCard.php" method="post">
			<input type="hidden" name="id_rando" value="<?php echo $donnees['id_rando']; ?>">
			<input type="hidden" name="action" value="<?php echo $action; ?>">
			<tr>
				<td>
					<label for="name">Nom : </label>
				</td>
				<td>
					<input type="text" id="name" name="name" value="<?php echo $donnees['name']; ?>">
				</td>
			</tr>
			<tr>
				<td>
					<label for="distance">Distance : </label>
				</td>
				<td>
					<input type="text" id="distance" name="distance" value="<?php echo $donnees['distance']; ?>">
				</td>
			</tr>
			<tr>
				<td><label for="difficulte">Difficulte : </label></td>
				<td>
					<select id="difficulte" name="difficulte">
						<option value="<?php echo $donnees['difficulte']; ?>"><?php echo $donnees['difficulte']; ?></option>
						<option value="facile">Facile</option>
						<option value="moyen">Moyen</option>
						<option value="difficile">Difficile</option>
					</select>
				</td>
			</tr>
			<tr>
				<td>
					<button type="submit">Valider</button>
				</td>
		</form>
				<td>
					<form action="http://localhost/dolibarr/htdocs/custom/rando/reboot/test3/randoCard.php" method="post">
						<input type="hidden" name="id_rando" value="<?php echo $donnees['id_rando']; ?>">
						<input type="hidden" name="action" value="deleteRando">
						<button type="submit">Supprimer</button>
					</form>
				</td>
			</tr>
	</table>
	<br>

	
	<?php
	$randos = new Rando();
	$randos -> fetchAllRando();
	$reponse = $randos->fetchAllRando($req);
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
		?><!--  on ferme le php-->
	
		<tr>
			<td>
				<a href="http://localhost/dolibarr/htdocs/custom/rando/reboot/test3/randoCard.php?id_rando=<?php echo $donnees['id_rando']; ?>">
				   <?php echo $donnees['name']; ?>
				</a>
			</td>
			<td>
				<?php echo $donnees['distance']; ?>
			</td>
			<td>
				<?php echo $donnees['difficulte']; ?>
			</td>
		</tr>
  		
		<?php
		} // fin de la boucle while
		?>
		
	</table>
	
	<?php
	$reponse->closeCursor(); // Termine le traitement de la requête

	include '../layout/layoutEnd.php';
