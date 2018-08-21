<?php
	include 'data.php';
?>
<!DOCTYPE html>
<html>
	<head>
	<style>
		table {
		border: 1px solid black;
		}
		td {
			width: 200px;
			text-align: center;
		}
	</style>
	</head>
	<body>
	
		<div class="container">
			<a href="http://localhost/dolibarr/htdocs/custom/rando/reboot/card.php" >Créér nouvelle rando</a>
			<h4>List</h4>
			<table>
				<tr>
					<td><h4>NOM</h4></td>
					<td><h4>DISTANCE</h4></td>
					<td><h4>DIFFICULTE</h4></td>
				</tr>

				<?php 
					foreach($TRandos AS $id => $rando) {
						print '<tr>				
								<td><a href="http://localhost/dolibarr/htdocs/custom/rando/reboot/card.php?id='
								.$rando['id'].'&nom='.$rando['nom'].'&distance='.$rando['distance'].'&difficulte='.$rando['difficulte'].'">'.$rando['nom'].'</a></td>
								<td>'.$rando['distance'].'</td>
							</tr>';
					}
				?>

			</table>
		</div>
	</body>
</html>