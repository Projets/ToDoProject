<?php
/*-traitement de l'ajout d'utilisateur sur accueil.php-*/
include('helpers/connect.php');
if (isset($_POST['new_login']) && isset($_POST['new_password']) && isset($_POST['new_mail1']) && isset($_POST['new_mail2']))
{
	$nlogin=$_POST['new_login'];
	$nmdp=md5($_POST['new_password']);
	$mail1=$_POST['new_mail1'];
	$mail2=$_POST['new_mail2'];
	$cond=$_POST['cond'];

		if ($mail1 == $mail2)
		{
			$sql0 = "select count(*) from users where login='$nlogin';";
			$query0 = $pdo->prepare($sql0);
			$query0->execute();
			while($line=$query0->fetch()) 
			{
				if($line['count(*)']==1) {
					$already_use="yes";
				}
			}
			if(!isset($already_use)) {
				$sql = "INSERT INTO `users` (`login`, `mdp`, `mail`) VALUES ('$nlogin','$nmdp','$mail1');";
				$query = $pdo->prepare($sql);
				$query->execute();
				$insert_user="yes";
			}
		}
		if ($mail1 != $mail2)
		{
			$error_mail='yes';
		}
}
?>
