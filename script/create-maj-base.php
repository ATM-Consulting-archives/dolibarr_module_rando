<?php
/*
 * Script créant et vérifiant que les champs requis s'ajoutent bien
 */

if(!defined('INC_FROM_DOLIBARR')) {
	define('INC_FROM_CRON_SCRIPT', true);

	require('../config.php');
} else {
	global $db;
}

dol_include_once('/rando/class/rando.class.php');
dol_include_once('/rando/class/level.class.php');

$o=new rando($db);
$o->init_db_by_vars();

$o=new level($db);
$o->init_db_by_vars();

