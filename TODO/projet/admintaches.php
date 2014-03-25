<?php 
include('helpers/session.php');
if(!isset($_SESSION['admin']) || $_SESSION['admin']!=1) {
	header("location:index.php");
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
	<p class='title'>Voici la vue d'ensemble des tâches composants la base de données</p>
<?php
	include('helpers/connect.php');
		
		
		$sql = "select todo.id, titre, resume, limite, priorite, u.login from todo 
		join users u on u.id=idProprietaire  
		order by limite desc, priorite desc;";
		$query = $pdo->prepare($sql);
		$query->execute();
		
		echo "<table id='todo' class='button'>";
		echo "<tr><th>titre</th><th>date limite</th><th>priorité</th><th>propriétaire</th><th>résumé</th></tr>";
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
	?>
	<div id='footer'>
		<?php 
		date_default_timezone_set('Europe/Paris');
		echo "<div id='currentdate' class='button'>La date d'aujourd'hui: ".date('Y-M-d')."
			<p id='supprimeobselettes'><a href='obselettes.php'>Supprimer les tâches terminées</a></p>
			</div>";
		?>
	</div>


</body>
</html>
