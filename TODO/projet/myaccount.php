<?php 
include('helpers/session.php');
?>
<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>TODO</title>
  <?php include('helpers/style.php'); ?>
</head>

<?php include('header.php'); ?>

<body>
	
	<?php
		$nom=htmlentities($_SESSION['login']);
		$idsession=$_SESSION['id'];
		
		echo "<p class='title'>Voici vos informations: </p>";
			
		include('helpers/connect.php');
		
		$sql = "select login, mail from users where id='$idsession';";
		$query = $pdo->prepare($sql);
		$query->execute();
		
		while($line=$query->fetch()) 
			{
				echo "<div class='compte'>";
				echo "<p class='mesInfos'><b>Login </b> : ".$line['login']."</p>";
				echo "<p class='mesInfos'><b>E-mail </b> : ".$line['mail']."</p>";
				echo"</div>";
			}
	?>
	
	<p class='mesInfos' >Envoyer mes informations par <a href='mail.php'>mail</a></p>
	<p class='mesInfos' ><a href='delete_my_account.php'>Supprimer mon compte</a></p>
	
	

</body>
</html>


