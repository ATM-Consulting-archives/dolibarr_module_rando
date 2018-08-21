<?php
	include '../connect.php';
	
	$reponse = $bdd->prepare('SELECT * FROM rando');// On récupère tout le contenu de la table rando
	
	$reponse->execute(array('name' => $_GET['name']));

