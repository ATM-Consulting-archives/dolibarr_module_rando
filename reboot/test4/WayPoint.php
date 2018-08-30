<?php
include_once 'SeedObject.php';

class WayPoint extends SeedObject {

	// Descripteurs
	
	public $bddTable = 'wayPoint';
	
	public $TFields = array (
			'id' => 'int'
			,'lattitude' => 'varchar(255)'
			,'longitude' => 'varchar(255)'
			,'fk_id_rando' => 'int'
	);
	
	// Données
	
	public $lattitude;
	public $longitude;
	public $fk_id_rando;

}
