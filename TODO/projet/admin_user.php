<?php 
include('helpers/session.php');
if(!isset($_SESSION['admin']) || $_SESSION['admin']!=1) {
	header("location:index.php");
}
if(!isset($_GET['idUser'])){
	header("location:admin.php");
}
$id_user=$_GET['idUser'];
?>
<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>TODO</title>
  <?php include('helpers/style.php'); ?>
</head>

<?php include('header.php'); ?>
<?php 
	include('helpers/connect.php');
	$sql="select login from users where id=$id_user;";
	$query=$pdo->prepare($sql);
	$query->execute();
	while($line=$query->fetch()) $login_user=$line['login'];

	echo "<p class='title'>Voulez vous supprimer l'utilisateur $login_user ?</p>";
	
	echo "<div id='delete_user_admin1' class='button'>
			<a href='admin_delete_user.php?idUser=$id_user'>OUI</a>
		</div>
		<div id='delete_user_admin2' class='button'>
			<a href='admin.php'>NON</a>
		</div>";
		
	echo "<p class='title'>Voici la liste de ses tâches</p>";
	/*-affiche les taches-*/
		$sql = "select t.id, t.titre, t.resume, t.limite, t.priorite, u.login from todo t 
		join users u on u.id=t.idProprietaire  
		where t.idProprietaire='$id_user' 
		union select t2.id, t2.titre, t2.resume, t2.limite, t2.priorite, u2.login from todo t2 
		join users u2 on t2.idProprietaire=u2.id 
		join multitache on idTodo = t2.id 
		where idUser='$id_user' 
		order by limite desc, priorite desc;";
		$query = $pdo->prepare($sql);
		$query->execute();
		
		echo "<table id='todo' class='button'>";
		echo "<tr><th>Titre</th><th>Date limite</th><th>Priorité</th><th>Propriétaire</th><th>Résumé</th></tr>";
		$i=1;
		while($line=$query->fetch()) 
			{
				$id=$line['id'];
				if($i%2==0){
				echo "<tr class='tablefonce'>";
				echo "<td><a href='modiftache.php?id=$id'>".$line['titre']."</a></td>";
				echo "<td><a href='modiftache.php?id=$id'>".$line['limite']."</a></td>";
				echo "<td><a href='modiftache.php?id=$id'>".$line['priorite']."</a></td>";
				echo "<td><a href='modiftache.php?id=$id'>".$line['login']."</a></td>";
				if ($line['resume'] != null)
					echo "<td class='fix_cell'><a href='modiftache.php?id=$id'>".$line['resume']."</a></td>";
					else
					echo "<td><a href='modiftache.php?id=$id'>Pas de résumé disponible</a></td>";
				echo"</tr>";
				} else {
				echo "<tr class='tableclair'>";
				echo "<td><a href='modiftache.php?id=$id'>".$line['titre']."</a></td>";
				echo "<td><a href='modiftache.php?id=$id'>".$line['limite']."</a></td>";
				echo "<td><a href='modiftache.php?id=$id'>".$line['priorite']."</a></td>";
				echo "<td><a href='modiftache.php?id=$id'>".$line['login']."</a></td>";
				if ($line['resume'] != null)
					echo "<td class='fix_cell'><a href='modiftache.php?id=$id'>".$line['resume']."</a></td>";
					else
					echo "<td><a href='modiftache.php?id=$id'>Pas de résumé disponible</a></td>";
				echo"</tr>";
			}
			$i++;
			}
		echo "</table>";
		/*-indique qu'il n'y as pas de taches si c'est le cas-*/
		if ($i==1)
		{
			echo "<p id='pasdetaches'>L'utilisateur n'a aucune tâche </p>";
		}
?>
