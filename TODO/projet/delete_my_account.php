<?php 
/*-traitement de la demande de suppression de compte sur myaccount.php-*/
include('helpers/session.php');

		$idsession=$_SESSION['id'];
			
		include('helpers/connect.php');
		
		$sql = "delete from users where id='$idsession';";
		$query = $pdo->prepare($sql);
		$query->execute();
		$sql = "delete from todo where idProprietaire='$idsession';";
		$query = $pdo->prepare($sql);
		$query->execute();
		
		session_destroy();
		include('helpers/style.php');
		echo "<p id='goodbye'>Suppression de votre compte...</p>";
		header('Refresh:2;URL=accueil.php');

?>
