<?php
include_once 'SeedObject.php';

class Rando extends SeedObject {
	
	// Descripteurs
	
	public $bddTable = 'rando';
	
	public $TFields = array (
						'id' => 'int'
						,'name' => 'varchar(255)'
						,'distance' => 'varchar(255)'
						,'difficulte' => 'varchar(255)'
	);
	
	public $TReferences = array(
						'WayPoint' => 'fk_id_rando'
						,'Randonneur' => 'fk_rando'
 	);

	// Données

	public $name;
	public $distance;
	public $difficulte;
	public $TWayPoints = array();
	public $TRandonneurs = array();
}
