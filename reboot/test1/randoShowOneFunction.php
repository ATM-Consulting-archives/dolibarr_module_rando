<?php 

	include '../connect.php';

	$reponse = $bdd->prepare('SELECT * FROM rando WHERE id = :id');
	
	$reponse->execute(array('id' => $_GET['id']));
	
	$donnees = $reponse->fetch();
	
