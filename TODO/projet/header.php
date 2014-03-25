<?php
/*-contient le header et le menu -*/
	if (isset($_SESSION['login'])) {
		echo "<a class='lien_header' href='index.php'><div id='header' class='button'>";
		echo "<div id='header_session'>Connecté en tant que ".$_SESSION['login'];
		if(isset($_SESSION['admin']) && $_SESSION['admin']==1) {
			echo " (admin)";
		}
		echo "</div>";
	}
	else {
		echo "<a class='lien_header' href='accueil.php'><div id='header' class='button'>";
		echo "<div id='header_session'>Connectez-vous pour découvrir TODO.fr !</div>";
	}
	
/*	echo "<div id='footer'>";	
	echo "<iframe name='date du jour' id='date-du-jour' src='http://www.mathieuweb.fr/calendrier/date-jour-bleu2.html' scrolling='no' frameborder='0' allowtransparency='true'></iframe>";
	echo "</div>";
*/	
	echo "<h1>TODO.fr</h1>";
	echo "<b id='slogan'>T'as une tâche, pistache !</b>";
	echo "</div></a>";
	if (isset($_SESSION['login'])) {
		echo "<div id='menu' class='button'>";
			echo "<ul>";
				echo "<li class='menu_left'><a class='lien_menu' href='index.php'>Accueil</a></li>";
				echo "<li><a class='lien_menu' href='taches.php'>Liste des tâches</a></li>";
				echo "<li><a class='lien_menu' href='ajouttache.php'>Nouvelle tâche</a></li>";
				if(isset($_SESSION['admin']) && $_SESSION['admin']==1) {
					echo "<li><a class='lien_menu' href='admin.php'>Administration</a></li>";
				} else {
					echo "<li><a class='lien_menu' href='myaccount.php'>Mon compte</a></li>";
				}
				echo "<li><a class='lien_menu' href='logout.php'>Se déconnecter</a></li>";
			echo "</ul>";
		echo "</div>";
	}
?>
	
