<?php

try
{
	$bdd = new PDO('mysql:host=localhost;dbname=randoTest2;charset=utf8', 'randoTest', 'randoTest', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));// On se connecte à MySQL
}
catch (Exception $e)
{
	die('Erreur : ' . $e->getMessage());// En cas d'erreur, on affiche un message et on arrête tout
}
