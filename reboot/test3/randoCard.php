<?php
include 'Rando.php';
include 'WayPoint.php';
include '../layout/layoutStart.php';


//je determine si j'ai des valeurs d'entrée par un id et j'affecte cette valeur à ma variable pour déterminer la suite
$id_rando = $_POST['id_rando'];

//je verifie si j'ai une valeur d'id
if (empty ($id_rando)) {
	$id_rando = $_GET['id_rando'];
}
if (!empty ($id_rando) ){
	$rando = new Rando();
	$donnees = $rando->fetchOneRando($rando, $id_rando);
}

//je determine si j'ai des actions à faire pour une rando
$action = $_POST['action'];
$action_wp = $_POST['action_wp'];
$act_btn = 'Enregistrer la saisie';

$titre = 'Formulaire de création';

if ($action === '') {
	$action = 'createRando';
}

if ($action == 'createRando') {
	$rando = new Rando();
	$rando -> createRando($rando, $_POST['name'], $_POST['distance'], $_POST['difficulte']);
	header('Location: randoCard.php');
	exit;
}

if ($action == 'updateRando') {
	$rando = new Rando();
	$rando -> updateRando($rando, $_POST['id_rando'], $_POST['name'], $_POST['distance'], $_POST['difficulte']);
	header('Location: randoCard.php');
	exit;
}

if ($action == 'deleteRando') {
	$rando = new Rando();
	$rando ->  deleteRando($rando, $_POST['id_rando']);
	header('Location: randoCard.php');
	exit;
}
if ($id_rando != '') {
	$action = 'updateRando';
	$act_btn = 'Enregistrer la modif';
	$titre = 'Formulaire de modifications';
}

//je determine si j'ai des actions à faire pour des wayPoint
$action_wp = $_POST['action_wp'];
$id_rando_for_wayPoint = (intval($_GET['id_rando']));

if ($action_wp === '') {
	$action_wp = 'createWayPoint';
}

if ($action_wp == 'createWayPoint') {
	$wayPoint = new WayPoint();
	$wayPoint -> createWayPoint($wayPoint, $_POST['lattitude'], $_POST['longitude'], $_POST['id_rando']);
	header('Location: randoCard.php?id_rando='. $donnees['id_rando']);
	exit;
}

if ($action_wp == 'updateWayPoint') {
	$wayPoint = new WayPoint();
	$wayPoint -> updateWayPoint($wayPoint, $_POST['id_wayPoint'], $_POST['lattitude'], $_POST['longitude']);
	header('Location: randoCard.php?id_rando='. $donnees['id_rando']);
	exit;
}

if ($action_wp == 'deleteWayPoint') {
	$wayPoint = new WayPoint();
	$wayPoint -> deleteWayPoint($wayPoint, $_POST['id_wayPoint']);
	header('Location: randoCard.php?id_rando='. $donnees['id_rando']);
	exit;
}


?>
		
<a href="http://localhost/dolibarr/htdocs/custom/rando/reboot/test3/randoCard.php">Créer une rando</a>

<h2><?php echo $titre ?></h2>

<table>
	<form action="http://localhost/dolibarr/htdocs/custom/rando/reboot/test3/randoCard.php" method="post">
		<input type="hidden" name="id_rando" value="<?php echo $donnees['id_rando']; ?>">
		<input type="hidden" name="action" value="<?php echo $action; ?>">
		<tr>
			<td>
				<label for="name">Nom : </label>
			</td>
			<td>
				<input type="text" id="name" name="name" value="<?php echo $donnees['name']; ?>" placeholder="saisir un nom de rando">
			</td>
		</tr>
		<tr>
			<td>
				<label for="distance">Distance : </label>
			</td>
			<td>
				<input type="text" id="distance" name="distance" value="<?php echo $donnees['distance']; ?>" placeholder="saisir une distance">
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
				<button type="submit"><?php echo $act_btn; ?></button>
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
<table class="center">
	<thead>
		<tr>
			<th colspan="2">WayPoint</th>
		</tr>
	</thead>
	<tr>
		<td>Lattitude</td>
		<td>Longitude</td>
	</tr>
	
	<?php 
	$wayPoint = new WayPoint();
	$reponse_wp = $wayPoint -> fetchRandoWayPoint($wayPoint, $id_rando_for_wayPoint);

	while ($donnees_wp = $reponse_wp->fetch()) // On affiche chaque entrée une à une
	{
	?><!--  on ferme le php-->

	<tr>
		<form action="http://localhost/dolibarr/htdocs/custom/rando/reboot/test3/randoCard.php" method="post">
			<input type="hidden" name="id_wayPoint" value="<?php echo $donnees_wp['id_wayPoint']; ?>">
			<input type="hidden" name="id_rando" value="<?php echo $donnees['id_rando']; ?>">
			<input type="hidden" name="action_wp" value="updateWayPoint">
			<td>
				<input type="text" id="lattitude" name="lattitude" value="<?php echo $donnees_wp['lattitude']; ?>">			 
			</td>
			<td>
				<input type="text" id="longitude" name="longitude" value="<?php echo $donnees_wp['longitude']; ?>">
			</td>
			<td>
				<button type="submit">Modifier</button>
			</td>
		</form>
			<td>
				<form action="http://localhost/dolibarr/htdocs/custom/rando/reboot/test3/randoCard.php" method="post">
					<input type="hidden" name="id_wayPoint" value="<?php echo $donnees_wp['id_wayPoint']; ?>">
					<input type="hidden" name="id_rando" value="<?php echo $donnees['id_rando']; ?>">
						<input type="hidden" name="action_wp" value="deleteWayPoint">
						<button type="submit">Supprimer</button>
					</form>
				</td>
			
		</tr>
  			
		<?php
	} // fin de la boucle while
	?>
	
	<tr>
		<form action="http://localhost/dolibarr/htdocs/custom/rando/reboot/test3/randoCard.php" method="post">
			<input type="hidden" name="id_wayPoint" value="<?php echo $donnees_wp['id_wayPoint']; ?>">
			<input type="hidden" name="id_rando" value="<?php echo $donnees['id_rando']; ?>">
			<input type="hidden" name="action_wp" value="createWayPoint">
			<td>
				<input type="text" id="lattitude" name="lattitude" placeholder="saisir une lattitude">
			</td>
			<td>
				<input type="text" id="longitude" name="longitude" placeholder="saisir une longitude">
			</td>
			<td>
				<button type="submit">Sauvegarder le WayPoint</button>
			</td>
		</form>
	</tr>
</table>

<h2>Liste des randos</h2>

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