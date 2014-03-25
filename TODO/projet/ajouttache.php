<?php 
include('helpers/session.php');
include('addtache.php');
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
	
	<form action='#' method='post'>
		<table id='modif_todo' class='button'>
			<tr>
				<th><label for='tit'>Titre</label></th>
				<th><label for='res'>Résumé</label></th>
				<th><label for='lim'>Date limite</label></th>
				<th><label for='prio'>Priorité</label></th>
				<th><label for='multi'>Multiutilisateur</label></th>
				<td id='ajout_tache_button' rowspan=2><input type='submit' value='créer'/></td>
			</tr>
			<tr>
			<td>
				<input id='tit' type='text' name='titre' placeholder='titre de la tâche' required='required'/>
			</td>
			<td>
			<textarea style='resize: none;' id='res' name='resume' placeholder='entrez un résumé(optionnel)' rows='5' cols='50' ></textarea>
			</td>
			<td>
				<input id='lim' type='date' name='limite' min="2013-04-01" placeholder='AAAA-MM-JJ' required='required'/>
			</td>
			<td>
				<select id='prio' name='priorite'>
						<option value='1'>1 (faible)</option><option value='2'>2</option><option value='3' selected='selected'>3</option><option value='4'>4</option><option value='5'>5 (très élevée)</option>
				</select>
			</td>
			<td>
			<input id='multi' type='email' name='multitache' placeholder="entrez le mail d'une personne"/>
			<?php if(isset($mail_invalide)) echo "<p>Mail invalide</p>"; ?>
			</td>
			</tr>
		</table>
	</form>
	<?php 
		date_default_timezone_set('Europe/Paris');
		echo "<p class='title'>Aujourd'hui, nous sommes le: ".date('Y-m-d')."</p>";
	?>
</body>
</html>


