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
		echo "<p class='title'>".$nom.", voici la liste de toutes vos taches: </p>";
			
		include('helpers/connect.php');
		
		/*-affiche les taches-*/
		$sql = "select t.id, t.titre, t.resume, t.limite, t.priorite, u.login from todo t 
		join users u on u.id=t.idProprietaire  
		where t.idProprietaire='$idsession' 
		union select t2.id, t2.titre, t2.resume, t2.limite, t2.priorite, u2.login from todo t2 
		join users u2 on t2.idProprietaire=u2.id 
		join multitache on idTodo = t2.id 
		where idUser='$idsession' 
		order by limite desc, priorite desc;";
		$query = $pdo->prepare($sql);
		$query->execute();
		$nb=1;
		/*-indique qu'il n'y as pas de taches si c'est le cas-*/
		while($line=$query->fetch()) {$nb++;};
		if ($nb==1)
		{
			echo "<p id='pasdetaches'>Vous n'avez aucune tâche, Veuillez en <a href='ajouttache.php' class='lien'>créer une</a>.</p>";
		}
		else{ /*-sinon affiche les taches-*/
			$existe_taches=true;
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

	<div id='footer'>
		<?php 
		date_default_timezone_set('Europe/Paris');
		echo "<div id='currentdate' class='button'>La date d'aujourd'hui: ".date('Y-M-d');
			if(isset($existe_taches)) echo "<p id='supprimeobselettes'><a href='obselettes.php'>Supprimer les tâches terminées</a></p>";
			echo "</div>";
		?>
	</div>

</body>
</html>


