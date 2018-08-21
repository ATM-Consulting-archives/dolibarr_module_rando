<?php
	include '../connect.php';

	$reponse = $bdd->prepare('UPDATE rando SET name = :name, distance = :distance');
	
	$reponse->execute(array(
			
			'name' => $_POST['name'],
			'distance' => $_POST['distance'],
			
	));