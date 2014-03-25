<?php 
include('helpers/session.php');
if(!isset($_SESSION['admin']) || $_SESSION['admin']!=1) {
	header("location:index.php");
}
/*-traitement de l'ajout d'admin-*/
if (isset($_POST['login_admin']))
{
	include('helpers/connect.php');
	$login=$_POST['login_admin'];
	$sql = "select count(*) from users where login='$login';";
	$query = $pdo->prepare($sql);
	$query->execute();
	
	while($line=$query->fetch())
		{
			if ($line['count(*)']!=1)
			{
				$echec='yes';
			}
			else
			{
				$sql2 = "select admin from users where login='$login';";
				$query2 = $pdo->prepare($sql2);
				$query2->execute();
				while($line=$query2->fetch()) {
					if ($line['admin']!=1) {
						$sql3 = "UPDATE `users` SET `admin` = 1 WHERE login='$login';";
						$query3 = $pdo->prepare($sql3);
						$query3->execute();
				
						$create_admin="yes";
					} else {
						$already_admin="yes";
					}
				}
			}
		}
}
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
	
	<p class='title'>Bienvenue administrateur ! Vous disposez de droits particuliers, ce qui vous permet de modifier n'importe quelle tâche.</p>
	<p><a class='lien' href='admintaches.php'>Liste de toutes les tâches(tous utilisateurs)</a></p>
	
	<form id='new_admin' class='button' action='#' method='post'>
		<p><label for='input_admin'>Créer un administrateur </label><input id='input_admin' type='text' name='login_admin' required='required' placeholder='Entrez un login'/></p>
		<?php  if (isset($echec)) echo "<p>Ce login n'existe pas !</p>";
				if (isset($create_admin)) echo "<p>Un nouvel administrateur à été créé</p>";
				if (isset($already_admin)) echo "<p>Cet utilisateur est déja administrateur</p>";  ?>
		<input id='submit_admin' type='submit' value='Créer'/>
	</form>
	<div id='list_users'>
		<?php
		include('helpers/connect.php');
			$sql4="select id, login, mail, admin from users;";
			$query4=$pdo->prepare($sql4);
			$query4->execute();
			
			echo "<table id='todo' class='button'>";
			echo "<tr><th colspan='2'>Liste des utilisateurs</th></tr>";
			$i=0;
			while($line=$query4->fetch())
			{
				$idUser=$line['id'];
				if($line['admin']==1){
					if($i%2==0) {
						echo "<tr class='tablefonce'><td><a href='admin_user.php?idUser=$idUser'>".$line['login']." (admin)</a></td><td><a href='admin_user.php?idUser=$idUser'>".$line['mail']."</a></td></tr>";
					} else {
						echo "<tr class='tableclair'><td><a href='admin_user.php?idUser=$idUser'>".$line['login']." (admin)</a></td><td><a href='admin_user.php?idUser=$idUser'>".$line['mail']."</a></td></tr>";
					}
				} else {
					if($i%2==0) {
						echo "<tr class='tablefonce'><td><a href='admin_user.php?idUser=$idUser'>".$line['login']."</a></td><td><a href='admin_user.php?idUser=$idUser'>".$line['mail']."</a></td></tr>";
					} else {
						echo "<tr class='tableclair'><td><a href='admin_user.php?idUser=$idUser'>".$line['login']."</a></td><td><a href='admin_user.php?idUser=$idUser'>".$line['mail']."</a></td></tr>";
					}
				}
				$i++;
			}
			echo "</table>";
		?>
	</div>

</body>
</html>

