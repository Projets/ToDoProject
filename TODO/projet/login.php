<?php session_start();
if (isset($_SESSION['login']))
	header('location:index.php');
include('verify_log.php');
 ?>
<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>TODO</title>
  <?php include('helpers/style.php'); ?>
</head>

<?php
include('header.php');
?>

<body>
	
	<div id='login'>
		<form method='post' action='#'>
			<p><input id='log' class='form_input' type='text' name='login' placeholder='Login' required='required'/></p>
			<p><input id='pass' class='form_input' type='password' name='password'placeholder='Mot de passe' required='required'/></p>
			<?php  if (isset($echec)) echo "Echec d'autentification !";  ?>
			<input id='log_button' class='button' type='submit' value='Se connecter'/>  
		</form>
	</div>

</body>
</html>
