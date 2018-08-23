<?php
include '../connect2.php';
class Rando {
	
	public $id_rando;
	public $name;
	public $distance;
	public $difficulte;
	
	public function createRando(Rando $rando, $name, $distance, $difficulte) {
		global $bdd;//connexion à la bdd par une supervariable
		$req = $bdd->prepare('INSERT INTO rando(name, distance, difficulte) VALUES(:name, :distance, :difficulte)');
		
		$req->execute(array(
				'name' => $name
				,'distance' => $distance
				,'difficulte' => $difficulte
		));
	}
	
	public function fetchAllRando() {
		global $bdd;//connexion à la bdd par une supervariable
		$req = $bdd->query('SELECT id_rando, name, distance, difficulte FROM rando');
		
		return $req;
	}
	
	public function fetchOneRando(Rando $rando, $id_rando) {
		global $bdd;//connexion à la bdd par une supervariable
		$req = $bdd->query('SELECT id_rando, name, distance, difficulte FROM rando WHERE id_rando = '.$id_rando);
		
		return $req->fetch();//on récupére uniquement la bonne ligne
	}
	
	public function updateRando(Rando $rando, $id_rando, $name, $distance, $difficulte) {
		global $bdd;//connexion à la bdd par une supervariable
		$reponse = $bdd->prepare('UPDATE rando SET name = :name, distance = :distance, difficulte = :difficulte WHERE id_rando = :id_rando');
		
		$reponse->execute(array(
				'id_rando' => $_POST['id_rando']
				,'name' => $_POST['name']
				,'distance' => $_POST['distance']
				,'difficulte' => $_POST['difficulte']
		));
	}
	
	public function deleteRando(Rando $rando, $id_rando) {
		global $bdd;//connexion à la bdd par une supervariable
		$reponse = $bdd->prepare('DELETE FROM rando WHERE id_rando = :id_rando');
		
		$reponse->execute(array(
				'id_rando' => $_POST['id_rando']
		));
	}
		
}
