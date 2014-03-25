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

<?php
	$idsession=$_SESSION['id'];
	
	include('helpers/connect.php');
	/*-vérifie si il y a des taches obseletes-*/
	date_default_timezone_set('Europe/Paris');
	if(isset($_SESSION['admin']) && $_SESSION['admin']==1) {/*si admin*/
		$sql = "select count(*), t.id, t.titre, t.resume, t.limite, t.priorite, u.login from todo t 
		join users u on u.id=t.idProprietaire  
		and limite < '".date('Y-m-d')."';";
	}
	else {/* si non-admin*/
		$sql = "select count(*), t.id, t.titre, t.resume, t.limite, t.priorite, u.login from todo t 
		join users u on u.id=t.idProprietaire  
		where t.idProprietaire='$idsession'
		and limite < '".date('Y-m-d')."';";
	}
		$query = $pdo->prepare($sql);
		$query->execute();
	while($line=$query->fetch()) 
			{
				if($line['count(*)']==0){
					echo "<p id='pasdetaches'>vous n'avez aucune tâche terminée</p>";
					header('Refresh:2;URL=taches.php');
				}
				else {
					$obseletes="oui";
				}
			}
	if (isset($obseletes) && $obseletes=="oui")
	{
	/*-demande si l'utilisateur veut les supprimer-*/
	echo "<p class='title'>Ces tâches vont être supprimées, continuer?</p>";
	
	echo "<div id='delete_obselettes' class='button'>
			<a href='deleteobselettes.php'>OUI</a>
		</div>
		<div id='delete_obselettes' class='button'>
			<a href='taches.php'>NON</a>
		</div>";
		/*-affiche les taches obseletes à supprimer-*/
		date_default_timezone_set('Europe/Paris');
		if(isset($_SESSION['admin']) && $_SESSION['admin']==1) {/*si admin*/
			$sql = "select t.id, t.titre, t.resume, t.limite, t.priorite, u.login from todo t 
			join users u on u.id=t.idProprietaire  
			and limite < '".date('Y-m-d')."';";
		} else { /*si non-admin-*/
			$sql = "select t.id, t.titre, t.resume, t.limite, t.priorite, u.login from todo t 
			join users u on u.id=t.idProprietaire  
			where t.idProprietaire='$idsession'
			and limite < '".date('Y-m-d')."';";
		}
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
	}
?>
