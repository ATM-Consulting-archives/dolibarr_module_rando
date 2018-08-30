<?php

include_once 'SeedObject.php';

class Randonneur extends SeedObject {

	// Descripteurs

	public $bddTable = 'randonneur';

	public $TFields = array(
		  'firstname'	=> 'varchar(32)'
		, 'lastname'	=> 'varchar(32)'
		, 'birthdate'	=> 'date'
		, 'fk_rando'	=> 'int'
	);

	// Données

	public $firstname;
	public $lastname;
	public $birthdate;
	public $fk_rando;
}