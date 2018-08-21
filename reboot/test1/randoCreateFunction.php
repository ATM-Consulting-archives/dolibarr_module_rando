<?php

include '../connect.php';

// On ajoute une entrée dans la table rando

$req = $bdd->prepare('INSERT INTO rando(name, distance) VALUES(:name, :distance)');

$req->execute(array(
		
		'name' => $_POST['name'],
		
		'distance' => $_POST['distance'],
				
));
// rediriger vers card.php comme ceci :
header('Location: randoCreate.php');
