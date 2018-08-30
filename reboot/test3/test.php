$messageRando = '';
$messageWayPoint = '';

if ($message !='') {
	if ($message == 'createRandoOk' || $message == 'updateRandoOk') {
		$message_a_afficher = $messageRando;
		if ($message == 'createRandoOK') {
			$displayMessage = 'est enregistée';
		} if ($message == 'updateRandoOk') {
			$displayMessage = 'à été modifiée';
		}
	} if ($message == 'createWayPointOk' || $message == 'updateWayPointOk') {
		$message_a_afficher = $messageWayPoint;
		if ($message == 'createWayPoint') {
			$displayMessage = 'est enregistée';
		} if ($message == 'updateWayPoint') {
			$displayMessage = 'à été modifiée';
		}
	}
}

$messageRando = 'La rando ' . $name_temp. ' d\'une distance de ' .$distance_temp. ' km et de difficulté ' .$difficulte_temp. ' '. $displayMessage;
$messageWayPoint = 'Le point de passage ' .$displayMessage;

