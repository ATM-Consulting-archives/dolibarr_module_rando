<?php

include_once 'SeedObject.php';

class User extends SeedObject {

	// Descripteurs

	public $bddTable = 'user';

	public $TFields = array(
		  'login'		=> 'varchar(255)'
		, 'firstname'	=> 'varchar(32)'
		, 'lastname'	=> 'varchar(32)'
		, 'birthdate'	=> 'date'
	);

	// Données

	public $login;
	public $firstname;
	public $lastname;
	public $birthdate;	
}