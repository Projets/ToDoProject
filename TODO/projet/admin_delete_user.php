<?php 
/*-traitement de la demande de suppression d'utilisateur sur admin_user.php-*/
include('helpers/session.php');
if(!isset($_SESSION['admin']) || $_SESSION['admin']!=1) {
	header("location:index.php");
}
if(!isset($_GET['idUser'])){
	header("location:admin.php");
}
$id_user=$_GET['idUser'];

	$idsession=$_SESSION['id'];
	
	include('helpers/connect.php');
				date_default_timezone_set('Europe/Paris');
		$sql = "delete from users
		where id='$id_user';";
		$query = $pdo->prepare($sql);
		$query->execute();
		include('helpers/style.php');
		echo "<p id='goodbye'>Suppression ...</p>";
		header('Refresh:1;URL=admin.php'); 
?>

