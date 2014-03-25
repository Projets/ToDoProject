<?php
if (isset($_SESSION['login']))
	header('location:index.php');
 include('adduser.php'); ?>
<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>TODO</title>
  <?php include('helpers/style.php'); ?>
</head>

<?php include('header.php'); ?>

<body>
	<div id='description'>
		<p class='title'>Venez découvrir TODO.fr, un site qui va vous aider à gérer vos tâches au quotidien.</p>
	</div>
	<div id='accounts'>
		<div id='inscript'>	
		<form method='post' action='#'>
			<p><input id='log' class='form_input' type='text' name='new_login' placeholder='Login' required='required'/></p>
			<?php if(isset($already_use)) echo "<p>Ce login est déja utilisé !</p>"; ?>
			<p><input id='pass' class='form_input' type='password' name='new_password' placeholder='Mot de passe' required='required'/></p>
			<p><input id='mail' class='form_input' type='email' name='new_mail1' placeholder='E-mail' required='required'/></p>
			<p><input id='mail' class='form_input' type='email' name='new_mail2' placeholder='Confirmez votre e-mail' required='required'/></p>
			<?php if(isset($error_mail)) echo "<p>Les mails sont différents !</p>"; 
					if(isset($insert_user)) echo "<p>L'utilisateur ".$nlogin." à bien été créé.</p>";
			?>
			<p class='conditions'><label for='conditions'> J'accepte les <a href='conditions.php' target=_blank>conditions</a></label><input id='conditions' type='checkbox' name='cond' value='ok' required='required'/></p>
			<input id='inscript_button' class='button' type='submit' value="S'inscrire"/>
		</form>
		</div>
		<div id='home_login'>
				<a id='home_log_button' class='button' href='login.php'>Se connecter</a>
		</div>
	</div>
</body>
</html>

