<?php
/*-traitement de modiftache.php-*/
if (!isset($_SESSION['login']))
header("location:accueil.php");

include('helpers/connect.php');

if(!isset($_SESSION['admin']) || $_SESSION['admin']!=1) {
		$sql = "select todo.idProprietaire from todo where id='$idtodo';";
		$query = $pdo->prepare($sql);
		$query->execute();
		
		while($line=$query->fetch()) 
			{
				$idpro=$line['idProprietaire'];
			}
		if ($idpro != $_SESSION['id']) {
		header("location:erreurmodif.php");
		}
	}

if (isset($_POST['titre']))
{
	$titre=htmlentities($_POST['titre']);
	$login=$_SESSION['login'];
	$idproprio=$_SESSION['id'];
	
	$sql = "UPDATE `todo` SET `titre` = \"$titre\" WHERE `todo`.`id` = $idtodo;";
	$query = $pdo->prepare($sql);
	$query->execute();
	
}
if (isset($_POST['priorite']))
{
	$priorite=$_POST['priorite'];
	$login=$_SESSION['login'];
	$idproprio=$_SESSION['id'];
	
	$sql = "UPDATE `todo` SET `priorite` = '$priorite' WHERE `todo`.`id` = $idtodo;";
	$query = $pdo->prepare($sql);
	$query->execute();
	
}
if (isset($_POST['limite']))
{
	$limite=$_POST['limite'];
	$login=$_SESSION['login'];
	$idproprio=$_SESSION['id'];
	
	$sql = "UPDATE `todo` SET `limite` = \"$limite\" WHERE `todo`.`id` = $idtodo;";
	$query = $pdo->prepare($sql);
	$query->execute();
	
}
if (isset($_POST['resume']) && $_POST['resume'] != '')
{
	$resume=htmlentities($_POST['resume']);
	$login=$_SESSION['login'];
	$idproprio=$_SESSION['id'];
	
	$sql = "UPDATE `todo` SET `resume` = \"$resume\" WHERE `todo`.`id` = $idtodo;";
	$query = $pdo->prepare($sql);
	$query->execute();
	
}
if (isset($_POST['suppr_tache']) && $_POST['suppr_tache'] == 'yes')
{
	$login=$_SESSION['login'];
	$idproprio=$_SESSION['id'];
	
	$sqldelete = "delete from `todo` WHERE `todo`.`id` = $idtodo;";
	$querydelete = $pdo->prepare($sqldelete);
	$querydelete->execute();
	
	header('location:index.php');
}
if (isset($_POST['multitache']) && $_POST['multitache'] != "")
	{
		$mail=$_POST['multitache'];
		$idproprio=$_SESSION['id'];
		
		$sql0 = "select count(*) from users where mail=\"$mail\";";
		$query0 = $pdo->prepare($sql0);
		$query0->execute();
		while($line0=$query0->fetch()) 
			{
				if($line0['count(*)']!=0)
				{
					$mail_valide="yes";
				}
				else {
					$mail_invalide="yes";
				}
			}
		if (isset($mail_valide) && $mail_valide=="yes") {
		
			$sql = "select id from users where mail='$mail';";
			$query = $pdo->prepare($sql);
			$query->execute();
			while($line=$query->fetch()) 
				{
					$iduser=$line['id'];
				}
			$sql = "INSERT INTO `multitache` VALUES ('$iduser', '$idtodo');";
			$query = $pdo->prepare($sql);
			$query->execute();
		}
		
	}
?>
