<?php
/*-détruit la session et redirige vers l'accueil-*/
	include('helpers/session.php');
	session_destroy();
	include('helpers/style.php');
	echo "<head>";
		echo '<meta charset="utf-8">';
		echo '<title>TODO</title>';
		include('helpers/style.php');
	echo "</head>";
	echo "<p id='goodbye'>Au revoir et à bientôt !</p>";
	header('Refresh:2;URL=accueil.php'); 
?>
