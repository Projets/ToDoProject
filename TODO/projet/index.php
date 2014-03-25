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
		$nom=$_SESSION['login'];
		$idsession=$_SESSION['id'];
		echo "<p class='title'>Bienvenue ".$nom.", voici les tâches planifiés pour aujourd'hui: </p>";
			
		include('helpers/connect.php');
		date_default_timezone_set('Europe/Paris');
		$date=date('Y-m-d');
		
		/*-vérifie si il y a des taches aujourd'hui-*/
		$sql = "select count(*), todo.id, titre, resume, limite, priorite, login from todo join users on users.id=idProprietaire where idProprietaire='$idsession' and limite='$date' order by limite desc, priorite desc;";
		$query = $pdo->prepare($sql);
		$query->execute();
		while($line=$query->fetch()) {
			if($line['count(*)']==0){ $pasdetodo1="yes"; }
			else { $tachedujour1="yes"; }
		}
		/*-verifie si il y a des taches partagées-*/
		$sql2="select count(*), t2.id, t2.titre, t2.resume, t2.limite, t2.priorite, u2.login from todo t2 
		join users u2 on t2.idProprietaire=u2.id 
		join multitache on idTodo = t2.id 
		where idUser='$idsession' 
		and t2.limite='$date' 
		order by limite desc, priorite desc;";
		$query2 = $pdo->prepare($sql2);
		$query2->execute();
		while($line2=$query2->fetch()) 
		{
			if($line2['count(*)']==0){ $pasdetodo2="yes"; }
			else { $tachedujour2="yes"; }
		}
		/*-si pas de taches aujourd'hui -*/
		if(isset($pasdetodo1) && isset($pasdetodo2)) {
			echo "<p id='pasdetaches'> Vous n'avez aucune(s) tâche(s) pour aujourd'hui </p>";
			/*-affiche le nombre de taches total-*/
			$sql3 = "select t.id, t.titre, t.resume, t.limite, t.priorite, u.login from todo t join users u on u.id=t.idProprietaire  where t.idProprietaire='$idsession' union select t2.id, t2.titre, t2.resume, t2.limite, t2.priorite, u2.login from todo t2 join users u2 on t2.idProprietaire=u2.id join multitache on idTodo = t2.id where idUser='$idsession' order by limite desc, priorite desc;";
			$query3 = $pdo->prepare($sql3);
			$query3->execute();
			$nbtaches=0;
			while($line3=$query3->fetch()) { $nbtaches++; }
			if($nbtaches==1) { echo "<p id='pasdetaches2'><a class='lien' href='taches.php'>Vous avez ".$nbtaches." tâche au total</a></p>"; }
			if($nbtaches>1) { echo "<p id='pasdetaches2'><a class='lien' href='taches.php'>Vous avez ".$nbtaches." tâches au total</a></p>"; }
		}
		//*-affiche les taches du jour si il y en a-*/
		if (isset($tachedujour1) || isset($tachedujour2))
		{
			$existe_taches_jour=true;
			$sql4 = "select t.id, t.titre, t.resume, t.limite, t.priorite, u.login from todo t 
			join users u on u.id=t.idProprietaire  
			where t.idProprietaire='$idsession' 
			and t.limite='$date' 
			union select t2.id, t2.titre, t2.resume, t2.limite, t2.priorite, u2.login from todo t2 
			join users u2 on t2.idProprietaire=u2.id 
			join multitache on idTodo = t2.id 
			where idUser='$idsession' 
			and t2.limite='$date'
			order by limite desc, priorite desc;";
			$query4 = $pdo->prepare($sql4);
			$query4->execute();
			echo "<table id='todo' class='button'>";
			echo "<tr><th>Titre</th><th>Date limite</th><th>Priorité</th><th>Propriétaire</th><th>Résumé</th></tr>";
			while($line4=$query4->fetch()) 
				{
					$id=$line4['id'];
					echo "<tr>";
					echo "<td><a href='modiftache.php?id=$id'>".$line4['titre']."</a></td>";
					echo "<td><a href='modiftache.php?id=$id'>Aujourd'hui</a></td>";
					echo "<td><a href='modiftache.php?id=$id'>".$line4['priorite']."</a></td>";
					echo "<td><a href='modiftache.php?id=$id'>".$line4['login']."</a></td>";
					if ($line4['resume'] != null)
						echo "<td class='fix_cell'><a href='modiftache.php?id=$id'>".$line4['resume']."</a></td>";
					else
						echo "<td><a href='modiftache.php?id=$id'>Pas de résumé disponible</a></td>";
					echo"</tr>";
				}
			echo "</table>";
		}
	?>
	
	<div id='footer'>
		<?php 
		date_default_timezone_set('Europe/Paris');
		echo "<div id='currentdate' class='button'>La date d'aujourd'hui: ".date('Y-M-d');
			if(isset($existe_taches_jour)) echo "<p id='supprimeobselettes'><a href='obselettes.php'>Supprimer les tâches terminées</a></p>";
			echo "</div>";
		?>
	</div>
	
	
</body>
</html>


