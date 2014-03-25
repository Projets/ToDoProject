
<?php
/*-traitement de ajouttache.php-*/
if (!isset($_SESSION['login']))
header("location:accueil.php");

include('helpers/connect.php');

if (isset($_POST['titre']) && isset($_POST['priorite']) && isset($_POST['limite']))
{
	$titre=htmlentities($_POST['titre']);
	$priorite=$_POST['priorite'];
	$limite=htmlentities($_POST['limite']);
	$login=$_SESSION['login'];
	$idproprio=$_SESSION['id'];
	if ($_POST['resume'] != '')
	{
		$resume=htmlentities($_POST['resume']);
		$sql = "INSERT INTO `todo` (`titre`, `resume`, `limite`,`priorite`, `idProprietaire`) VALUES (\"$titre\",\"$resume\",\"$limite\", '$priorite', '$idproprio' );";
		$query = $pdo->prepare($sql);
		$query->execute();
	}
	else
	{
		$sql = "INSERT INTO `todo` (`titre`, `limite`,`priorite`, `idProprietaire`) VALUES (\"$titre\",\"$limite\", '$priorite', '$idproprio');";
		$query = $pdo->prepare($sql);
		$query->execute();
	}
	if (isset($_POST['multitache']) && $_POST['multitache'] != "")
	{
		$mail=$_POST['multitache'];
		$sql0 = "select count(*) from users where mail='$mail';";
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
			$sql = "select id from users where mail=\"$mail\";";
			$query = $pdo->prepare($sql);
			$query->execute();
			while($line=$query->fetch()) 
				{
					$iduser=$line['id'];
				}
			$sql = "select id from todo where titre='$titre' and idProprietaire='$idproprio';";
			$query = $pdo->prepare($sql);
			$query->execute();
			while($line=$query->fetch()) 
				{
					$idtache=$line['id'];
				}
			$sql = "INSERT INTO `multitache` VALUES ('$iduser', '$idtache');";
			$query = $pdo->prepare($sql);
			$query->execute();
			
		}
		
	}
	header('location:index.php');
}

?>
