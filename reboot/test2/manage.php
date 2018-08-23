<?php 

try
{
	$bdd = new PDO('mysql:host=localhost;dbname=randoTest;charset=utf8', 'randoTest', 'randoTest', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));// On se connecte à MySQL
}
catch (Exception $e)
{
	die('Erreur : ' . $e->getMessage());// En cas d'erreur, on affiche un message et on arrête tout
}

// $heure = time();
// $requete = "CREATE DATABASE test$heure DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci";
// $bdd->prepare($requete)->execute();


//fonction pour les rando
function createRando ($name, $distance, $difficulte) {
	global $bdd;
	$req = $bdd->prepare('INSERT INTO rando(name, distance, difficulte) VALUES(:name, :distance, :difficulte)');
	
	$req->execute(array(
			'name' => $name
			,'distance' => $distance
			,'difficulte' => $difficulte
	));
}

function fetchAllRando () {
	global $bdd;
	$req = $bdd->query('SELECT * FROM rando');

	return $req;
}

function fetchOneRando ($id_rando) {
	global $bdd;
	$req = $bdd->query('SELECT * FROM rando WHERE id_rando = '.$id_rando);
	
	return $req->fetch();//on récupére uniquement la bonne ligne
}

function updateRando ($id_rando, $name, $distance, $difficulte) {
	global $bdd;
	$reponse = $bdd->prepare('UPDATE rando SET name = :name, distance = :distance, difficulte = :difficulte WHERE id_rando = :id_rando');
	
	$reponse->execute(array(
			'id_rando' => $_POST['id_rando']
			,'name' => $_POST['name']
			,'distance' => $_POST['distance']
			,'difficulte' => $_POST['difficulte']
	));
}

function deleteRando($id_rando) {
	global $bdd;
	$reponse = $bdd->prepare('DELETE FROM rando WHERE id_rando = :id_rando');
	
	$reponse->execute(array(
			'id_rando' => $_POST['id_rando']
	));
}

//fonction pour les wayPoint
function createWayPoint($lattitude, $longitude, $id_rando) {
 	
	global $bdd;
	$req_wp = $bdd->prepare('INSERT INTO wayPoint(lattitude, longitude, fk_id_rando) VALUES(:lattitude, :longitude, :fk_id_rando)');
	
	$req_wp->execute(array(
			'lattitude' => $lattitude
			,'longitude' => $longitude
			,'fk_id_rando' => $id_rando
	));
	return;
}

function fetchAllWayPoint () {
	global $bdd;
	$req_wp = $bdd->query('SELECT * FROM wayPoint');
	
	return $req_wp;
}

function fetchRandoWayPoint ($id_rando_for_wayPoint) {

	global $bdd;
	$req = 'SELECT * FROM wayPoint WHERE fk_id_rando = '.$id_rando_for_wayPoint;
	$req_wp = $bdd->query($req);
	
	return $req_wp;
}

function updateWayPoint($id_wayPoint, $lattitude, $longitude) {
	global $bdd;
	$reponse_wp = $bdd->prepare('UPDATE wayPoint SET lattitude = :lattitude, longitude = :longitude WHERE id_wayPoint= :id_wayPoint');
	
	$reponse_wp->execute(array(
			'id_wayPoint' => $_POST['id_wayPoint']
			,'lattitude' => $_POST['lattitude']
			,'longitude' => $_POST['longitude']
	));
}

function deleteWayPoint ($id_wayPoint) {
	global $bdd;
	$reponse_wp = $bdd->prepare('DELETE FROM wayPoint WHERE id_wayPoint = :id_wayPoint');
	
	$reponse_wp->execute(array(
			'id_wayPoint' => $_POST['id_wayPoint']
	));
}

