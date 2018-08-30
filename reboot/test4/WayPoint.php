<?php
include_once 'SeedObject.php';

class WayPoint extends SeedObject {
	
	public $bddTable = 'wayPoint'
						,$lattitude
						,$longitude
						,$fk_id_rando;
	
	public $TFields = array (
						'id' => 'int'
						,'lattitude' => 'varchar(255)'
						,'longitude' => 'varchar(255)'
						,'fk_id_rando' => 'int'
	);
		
}
