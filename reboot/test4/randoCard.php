<?php
include 'SeedObject.php';
include 'Rando.php';
include 'WayPoint.php';
include_once 'Randonneur.class.php';


//je determine si j'ai des valeurs d'entrée par un id et j'affecte cette valeur à ma variable pour déterminer la suite
$id_rando = $_POST['id_rando'];

$rando = new Rando();

//je verifie si j'ai une valeur d'id
if (empty ($id_rando))
{
	$id_rando = $_GET['id_rando'];
}

if (!empty ($id_rando) )
{
	$TRet = $rando->fetchOne($id_rando);
// 	var_dump($TRet);
// 	exit;
	//if($ret < 0) setEventMessage('Error '.$ret, $rando->TErrors);
}

//je determine si j'ai des actions à faire pour une rando
$action = $_POST['action'];
$action_wp = $_POST['action_wp'];
$act_btn = 'Enregistrer la saisie';
$message = $_GET['answer'];
$titre = 'Formulaire de création';

if ($message !='')
{
	if ($message == 'createOk') {
		$displayMessage = 'est enregistée';
	} if ($message == 'updateOk') {
		$displayMessage = 'à été modifiée';
	}
}

if ($action === '')
{
	$action = 'createRando';
}

if ($action == 'createRando')
{
	$Trando = array();
	$Trando ['name'] = $_POST['name'];
	$Trando ['distance'] = $_POST['distance'];
	$Trando ['difficulte'] = $_POST['difficulte'];
		
	$rando -> create($Trando);
	header('Location: randoCard.php?answer=createOk&name_rando='.$rando->name.'&distance='.$rando->distance. '&difficulte=' .$rando->difficulte);
	exit;
}

if ($message != '')
{
	$name_temp = $_GET['name_rando'];
	$distance_temp = $_GET['distance'];
	$difficulte_temp = $_GET['difficulte'];
	$saveOk = 'La rando ' . $name_temp. ' d\'une distance de ' .$distance_temp. ' km et de difficulté ' .$difficulte_temp. ' '. $displayMessage;
}

if ($action == 'updateRando')
{
	$Trando = array();
	$Trando ['id'] = $_POST['id_rando'];
	$Trando ['name'] = $_POST['name'];
	$Trando ['distance'] = $_POST['distance'];
	$Trando ['difficulte'] = $_POST['difficulte'];

	$rando -> update($Trando);
	header('Location: randoCard.php?answer=updateOk&name_rando='.$rando->name.'&distance='.$rando->distance. '&difficulte=' .$rando->difficulte);
	exit;
}

if ($action == 'deleteRando')
{
	$rando -> delete();
	header('Location: randoCard.php');
	exit;
}
if ($id_rando != '')
{
	$action = 'updateRando';
	$act_btn = 'Enregistrer la modif';
	$titre = 'Formulaire de modifications';
}



//je determine si j'ai des actions à faire pour des wayPoint
$action_wp = $_POST['action_wp'];
$id_rando_for_wayPoint = (intval($_GET['id_rando']));

if ($action_wp === '')
{
	$action_wp = 'create';
}

if ($action_wp == 'createWayPoint')
{
	$TWayPoint ['lattitude'] = $_POST['lattitude'];
	$TWayPoint ['longitude'] = $_POST['longitude'];
	$TWayPoint ['fk_id_rando'] = $_POST['id_rando'];
	
	$wayPoint = new WayPoint();
	$wayPoint -> create($TWayPoint);
	header('Location: randoCard.php?answer=createWpOk&id_rando='. $rando->id);
	exit;
}

if ($action_wp == 'updateWayPoint')
{
	$TWayPoint ['id'] = $_POST['id_wayPoint'];
	$TWayPoint ['lattitude'] = $_POST['lattitude'];
	$TWayPoint ['longitude'] = $_POST['longitude'];
	$TWayPoint ['fk_id_rando'] = $_POST['fk_id_rando'];
	
	$wayPoint = new WayPoint();
	$wayPoint -> update($TWayPoint);
	header('Location: randoCard.php?answer=updateWpOk&id_rando='. $_POST['fk_id_rando']);
	exit;
}

if ($action_wp == 'deleteWayPoint')
{
	$wayPoint = new WayPoint();
	$id = $_POST['id_wayPoint'];
	$wayPoint->fetchOne($id);
	$wayPoint -> delete();
	header('Location: randoCard.php?id_rando='. $rando->id);
	exit;
}




include '../layout/layoutStart.php';
?>
<a href="http://localhost/dolibarr/htdocs/custom/rando/reboot/test4/randoCard.php">Créer une rando</a>

<h2><?php echo $titre ?></h2>
<p class="red"><?php echo $saveOk?>

<table>
	<form action="http://localhost/dolibarr/htdocs/custom/rando/reboot/test4/randoCard.php" method="post">
		<input type="hidden" name="id_rando" value="<?php echo $rando->id; ?>">
		<input type="hidden" name="action" value="<?php echo $action; ?>">
		<tr>
			<td>
				<label for="name">Nom : </label>
			</td>
			<td>
				<input type="text" id="name" name="name" value="<?php echo $rando->name ; ?>" placeholder="saisir un nom de rando">
			</td>
		</tr>
		<tr>
			<td>
				<label for="distance">Distance : </label>
			</td>
			<td>
				<input type="text" id="distance" name="distance" value="<?php echo  $rando->distance ; ?>" placeholder="saisir une distance">
			</td>
			<td>km</td>
		</tr>
		<tr>
			<td><label for="difficulte">Difficulte : </label></td>
			<td>
				<select id="difficulte" name="difficulte">
					<option value="<?php echo $rando->difficulte ; ?>"><?php echo $rando->difficulte ; ?></option>
					<option value="facile">Facile</option>
					<option value="moyenne">Moyenne</option>
					<option value="difficile">Difficile</option>
				</select>
			</td>
		</tr>
		<tr>
			<td>
				<button type="submit"><?php echo $act_btn; ?></button>
			</td>
	</form>
		<?php 
 		if (!empty($id_rando)) {
 		?>
			<td>
				<form action="http://localhost/dolibarr/htdocs/custom/rando/reboot/test4/randoCard.php" method="post">
					<input type="hidden" name="id_rando" value="<?php echo $rando->id; ?>">
					<input type="hidden" name="action" value="deleteRando">
					<button type="submit">Supprimer</button>
				</form>
			</td>
		<?php 
		}
		?>
		</tr>
</table>



<br>
	
	<?php 
	if (!empty($id_rando))
	{
	
		?>
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
		foreach ($rando->TWayPoints AS $wayPoint) // On affiche chaque entrée une à une
		{
		?><!--  on ferme le php-->
		
	
		<tr>
			<form action="http://localhost/dolibarr/htdocs/custom/rando/reboot/test4/randoCard.php" method="post">
				<input type="hidden" name="id_wayPoint" value="<?php echo $wayPoint->id; ?>">
				<input type="hidden" name="fk_id_rando" value="<?php echo $id_rando; ?>">
				<input type="hidden" name="action_wp" value="updateWayPoint">
				<td>
					<input type="text" id="lattitude" name="lattitude" value="<?php echo $wayPoint->lattitude ;?>">			 
				</td>
				<td>
					<input type="text" id="longitude" name="longitude" value="<?php echo $wayPoint->longitude; ?>">
				</td>
				<td>
					<button type="submit">Modifier</button>
				</td>
			</form>
				<td>
					<form action="http://localhost/dolibarr/htdocs/custom/rando/reboot/test4/randoCard.php" method="post">
						<input type="hidden" name="id_wayPoint" value="<?php echo $wayPoint->id; ?>">
						<input type="hidden" name="id_rando" value="<?php echo $id_rando; ?>">
							<input type="hidden" name="action_wp" value="deleteWayPoint">
							<button type="submit">Supprimer</button>
						</form>
					</td>
				
			</tr>
  		
		<?php
		} // fin de la boucle while

	?>
	
	<tr>
		<form action="http://localhost/dolibarr/htdocs/custom/rando/reboot/test4/randoCard.php" method="post">
			<input type="hidden" name="id_rando" value="<?php echo $id_rando; ?>">
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
<?php 
	}//fin de mon empty
?>

<h2>Liste des randos</h2>

<?php

$TRandos = $rando->fetchAll();

?>

<table>
	<tr>
		<td><h4>NOM</h4></td>
		<td><h4>DISTANCE</h4></td>
		<td><h4>DIFFICULTE</h4></td>
	</tr>
    	
	<?php
	foreach ($TRandos AS $rando) // On affiche chaque entrée une à une
	{
	?><!--  on ferme le php-->

	<tr>
		<td>
			<a href="http://localhost/dolibarr/htdocs/custom/rando/reboot/test4/randoCard.php?id_rando=<?php echo $rando->id; ?>">
			   <?php echo $rando->name; ?>
			</a>
		</td>
		<td>
			<?php echo $rando->distance; ?>
		</td>
		<td>
			<?php echo $rando->difficulte; ?>
			</td>
		</tr>
  		
		<?php
	} // fin de la boucle while
	?>
	
</table>

<?php

include '../layout/layoutEnd.php';