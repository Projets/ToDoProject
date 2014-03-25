<?php 
include('helpers/session.php');

$idtodo=$_GET['id'];

include('updatetache.php');
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
		include('helpers/connect.php');
		/*-affiche les inforamtions de la tache a modifier-*/
		$sql = "select users.id, titre, resume, limite, priorite, login from todo join users on users.id=idProprietaire where todo.id='$idtodo';";
		$query = $pdo->prepare($sql);
		$query->execute();
		
		echo "<table id='modif_todo' class='button'>";
		echo "<tr><th><label for='tit'>Titre</label></th>
		<th><label for='lim'>Date limite</label></th>
		<th><label for='prio'>Priorité</label></th>
		<th><label for='multi'>Propriétaire</label></th>
		<th><label for='res'>Résumé</label></th></tr>";
		while($line=$query->fetch()) 
			{
				$id=$line['id'];
				echo "<tr>";
				echo "<td><label for='tit'> ".$line['titre']."</label></td>";
				echo "<td><label for='lim'>".$line['limite']."</label></td>";
				echo "<td><label for='prio'>".$line['priorite']."</label></td>";
				echo "<td><label for='multi'>".$line['login']."</label></td>";
				if ($line['resume'] != null)
					echo "<td class='fix_cell'><p><label for='res'>".$line['resume']."</label></p></td>";
					else
					echo "<td><label for='res'>Pas de résumé disponible</label></td>";
				echo"</tr>";
			}
			/*-formulaires pour modifier les infos indépendament-*/
	?>
	<tr>
			<td><form action='#' method='post'>
				<p><input id='tit' type='text' name='titre' placeholder='Titre du todo' />
				<input type='submit' value='modifier'/></p>
			</form></td>
			<td><form action='#' method='post'>
				<p><input id='lim' type='date' name='limite' min="2013-04-01" placeholder='AAAA-MM-JJ' />
				<input type='submit' value='modifier'/></p>
			</form></td>
			<td><form action='#' method='post'>
				<p><select id='prio' name='priorite'>
							<option value='1'>1 (faible)</option><option value='2'>2</option><option value='3'>3</option><option value='4'>4</option><option value='5'>5 (très élevée)</option>
					   </select>
					   <input type='submit' value='modifier'/></p>
			</form></td>
			<td><form action='#' method='post'>
				<p><label for='multi'>Multiutilisateur (permet de lier une personne à la tâche) </label><input id='multi' type='email' name='multitache' placeholder="Entrez le mail d'une personne"/>
				<?php if(isset($mail_invalide)) echo "<p>Mail invalide</p>"; ?>
				<input type='submit' value='ajouter'/></p>
			</form></td>
			<td><form action='#' method='post'>
				<p><textarea style="resize: none;" id='res' type='text' name='resume' placeholder='Entrez un résumé(optionnel)' rows='5' cols='50' ></textarea>
				<input type='submit' value='modifier'/></p>
			</form></td>
		</tr>
	</table>
	<?php
	/*- affiche les utilisateurs déja liés a la tache si il y en a-*/
		$sql = "select count(*) from users join multitache on idUser=users.id where idTodo='$idtodo';";
		$query = $pdo->prepare($sql);
		$query->execute();
		while($line=$query->fetch()) {
			if($line['count(*)']!=0) $users_linked="yes";
		}
		if(isset($users_linked)) {
			echo "<p>Utilisateurs liés:";
			$sql = "select users.login from users join multitache on idUser=users.id where idTodo='$idtodo';";
			$query = $pdo->prepare($sql);
			$query->execute();
			while($line=$query->fetch()) 
				{
					echo " - ".$line['login'];
				}
			echo "</p>";
		}
		/*-supprime la tache-*/
	?>
	<div id='supprime_tache'></div>
	<form action='#' method='post'>
		<input type='checkbox' id='suppr_tache' name='suppr_tache' value='yes' checked='checked' />
		<input type='submit' id='suppr_button' value='Supprimer' class='button'/>
	</form>
	</div>
	
</body>
</html>
