<?php 
/*-cette page s'affiche si un utilisateur veut modifier une tache dont il n'est pas propriétaire-*/
include('helpers/session.php');
?>
<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>TODO</title>
  <?php include('helpers/style.php'); ?>
  <script src="script.js"></script>
</head>

<?php include('header.php');
echo "<body>";
	echo "<p id='goodbye'>Impossible de modifier le todo, vous n'en êtes pas le propriétaire !</p>";
echo "</body>";
echo "</html>";
header('Refresh:2;URL=index.php');
?>

