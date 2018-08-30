<?php
include_once 'SeedObject.php';

class Rando extends SeedObject {
	
	public $bddTable = 'rando'
						,$id
						,$name
						,$distance
						,$difficulte;
	
	public $TFields = array (
						'id' => 'int'
						,'name' => 'varchar(255)'
						,'distance' => 'varchar(255)'
						,'difficulte' => 'varchar(255)'
	);
		
}
