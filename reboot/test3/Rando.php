<?php 

try
{
	$bdd = new PDO('mysql:host=localhost;dbname=randoTest;charset=utf8', 'randoTest', 'randoTest', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));// On se connecte à MySQL
}
catch (Exception $e)
{
	die('Erreur : ' . $e->getMessage());// En cas d'erreur, on affiche un message et on arrête tout
}

class Rando {
	
	public $id;
	public $name;
	public $distance;
	public $difficulte;
		
	public function createRando(Rando $id_rando, $name, $distance, $difficulte) {
		global $bdd;
		
		$req = $bdd->prepare('INSERT INTO rando(name, distance, difficulte) VALUES(:name, :distance, :difficulte)');
		
		$req->execute(array(
				'name' => $name
				,'distance' => $distance
				,'difficulte' => $difficulte
		));
	}
	
	public function fetchAllRando() {
		global $bdd;
		
		$req = $bdd->query('SELECT * FROM rando');
		
		return $req;
	}
	
	public function fetchOneRando(Rando $randos, $id_rando) {
		global $bdd;
		$req = $bdd->query('SELECT * FROM rando WHERE id_rando = '.$id_rando);
		
		return $req->fetch();//on récupére uniquement la bonne ligne
	}
	
	public function updateRando(Rando $id_rando, $name, $distance, $difficulte) {
		global $bdd;
		$reponse = $bdd->prepare('UPDATE rando SET name = :name, distance = :distance, difficulte = :difficulte WHERE id_rando = :id_rando');
		
		$reponse->execute(array(
				'id_rando' => $_POST['id_rando']
				,'name' => $_POST['name']
				,'distance' => $_POST['distance']
				,'difficulte' => $_POST['difficulte']
		));
	}
	
	public function deleteRando(Rando $id_rando) {
		global $bdd;
		$reponse = $bdd->prepare('DELETE FROM rando WHERE id_rando = :id_rando');
		
		$reponse->execute(array(
				'id_rando' => $_POST['id_rando']
		));
	}
	
	
}


