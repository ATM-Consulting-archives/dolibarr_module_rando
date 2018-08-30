<?php
include '../connect2.php';
// include 'Rando.php';
class WayPoint {
	
	public $id_wayPoint;
	public $lattitude;
	public $longitude;
	public $fk_id_rando;
	
	public function createWayPoint($lattitude, $longitude, $id_rando) {
		$this -> lattitude = $lattitude;
		$this -> longitude = $longitude;
		$this -> id_rando = $id_rando;
		
		global $bdd;//connexion à la bdd par une supervariable
		$req_wp = $bdd->prepare('INSERT INTO wayPoint(lattitude, longitude, fk_id_rando) VALUES(:lattitude, :longitude, :fk_id_rando)');
		
		$req_wp->execute(array(
				'lattitude' => $lattitude
				,'longitude' => $longitude
				,'fk_id_rando' => $id_rando
		));
		$this -> id_wayPoint = $bdd -> lastInsertId();
	}
	
	public function fetchRandoWayPoint ($id_rando_for_wayPoint) {
		global $bdd;//connexion à la bdd par une supervariable
		$req = 'SELECT id_wayPoint, lattitude, longitude, fk_id_rando FROM wayPoint WHERE fk_id_rando = '.$id_rando_for_wayPoint;
		$req_wp = $bdd->query($req);
		
		return $req_wp;
	}
	
	public function updateWayPoint($id_wayPoint, $lattitude, $longitude) {
		$this -> lattitude = $lattitude;
		$this -> longitude = $longitude;
		
		global $bdd;//connexion à la bdd par une supervariable
		$reponse_wp = $bdd->prepare('UPDATE wayPoint SET lattitude = :lattitude, longitude = :longitude WHERE id_wayPoint= :id_wayPoint');
		
		$reponse_wp->execute(array(
				'id_wayPoint' => $_POST['id_wayPoint']
				,'lattitude' => $_POST['lattitude']
				,'longitude' => $_POST['longitude']
		));
		$this -> id_wayPoint;
	}
	
	public function deleteWayPoint ($id_wayPoint) {
		global $bdd;//connexion à la bdd par une supervariable
		$reponse_wp = $bdd->prepare('DELETE FROM wayPoint WHERE id_wayPoint = :id_wayPoint');
		
		$reponse_wp->execute(array(
				'id_wayPoint' => $_POST['id_wayPoint']
		));
	}
	
	
}