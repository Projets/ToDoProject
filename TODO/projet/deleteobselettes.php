<?php 
/*-traitement de la demande de suppression des taches obseletes sur obselettes.php-*/
include('helpers/session.php');

	$idsession=$_SESSION['id'];
	
	include('helpers/connect.php');
				date_default_timezone_set('Europe/Paris');
		$sql = "delete from todo
		where idProprietaire='$idsession'
		and limite < '".date('Y-m-d')."';";
		$query = $pdo->prepare($sql);
		$query->execute();
		include('helpers/style.php');
		echo "<p id='goodbye'>Suppression ...</p>";
		header('Refresh:1;URL=taches.php'); 
?>

