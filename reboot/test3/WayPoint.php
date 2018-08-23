<?php 

include '../connect2.php';
// include 'Rando.php';

class WayPoint {
	
	public $id_wayPoint;
	public $lattitude;
	public $longitude;
	public $fk_id_rando;

	public function createWayPoint(WayPoint $wayPoint, $lattitude, $longitude, $id_rando) {
		
		global $bdd;
		$req_wp = $bdd->prepare('INSERT INTO wayPoint(lattitude, longitude, fk_id_rando) VALUES(:lattitude, :longitude, :fk_id_rando)');
		
		$req_wp->execute(array(
				'lattitude' => $lattitude
				,'longitude' => $longitude
				,'fk_id_rando' => $id_rando
		));
		return;
	}
	
	public function fetchAllWayPoint () {
		global $bdd;
		$req_wp = $bdd->query('SELECT * FROM wayPoint');
		
		return $req_wp;
	}
	
	public function fetchRandoWayPoint (WayPoint $wayPoint, $id_rando_for_wayPoint) {
		
		global $bdd;
		$req = 'SELECT * FROM wayPoint WHERE fk_id_rando = '.$id_rando_for_wayPoint;
		$req_wp = $bdd->query($req);
		
		return $req_wp;
	}
	
	public function updateWayPoint(WayPoint $wayPoint, $id_wayPoint, $lattitude, $longitude) {
		global $bdd;
		$reponse_wp = $bdd->prepare('UPDATE wayPoint SET lattitude = :lattitude, longitude = :longitude WHERE id_wayPoint= :id_wayPoint');
		
		$reponse_wp->execute(array(
				'id_wayPoint' => $_POST['id_wayPoint']
				,'lattitude' => $_POST['lattitude']
				,'longitude' => $_POST['longitude']
		));
	}
	
	public function deleteWayPoint (WayPoint $wayPoint, $id_wayPoint) {
		global $bdd;
		$reponse_wp = $bdd->prepare('DELETE FROM wayPoint WHERE id_wayPoint = :id_wayPoint');
		
		$reponse_wp->execute(array(
				'id_wayPoint' => $_POST['id_wayPoint']
		));
	}
	
	
}