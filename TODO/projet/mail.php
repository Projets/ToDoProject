<?php 
/*- cette page est censée envoyer un mail à l'utilisateur, utilisée dans myaccount.php-*/
include('helpers/session.php');
?>
<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>TODO</title>
  <?php include('helpers/style.php'); ?>
</head>
	<?php
		$nom=htmlentities($_SESSION['login']);
		$idsession=$_SESSION['id'];
		
		include('helpers/connect.php');
		
		$sql = "select login, mail, mdp from users where id='$idsession';";
		$query = $pdo->prepare($sql);
		$query->execute();
		
		while($line=$query->fetch()) 
			{
				$login=$line['login'];
				$mail=$line['mail'];
			}
			
		mail('$mail', 'todo.fr', 'votre nom: $login');
		echo "<p id='goodbye'>Un mail a bien été envoyé à $mail</p>";
		header('Refresh:2;URL=myaccount.php'); 
	?>
