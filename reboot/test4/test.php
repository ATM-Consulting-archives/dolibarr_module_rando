
<?php 
$rando = new Rando();
$id = $_POST['id'];

$rando -> delete($id);
header('Location: randoCard.php');
exit;