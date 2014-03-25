<?php
/*-vérifie si l'utilisateur est dans la base et le connecte. utilisé dans login.php-*/
include('helpers/connect.php');

if (isset($_POST['login']) && isset($_POST['password']))
{
	$login=$_POST['login'];
	$mdp=md5($_POST['password']);

	$sql = "select count(*) from users where login='$login' and mdp='$mdp';";
	$query = $pdo->prepare($sql);
	$query->execute();
	
	while($line=$query->fetch()) 
		{
			if ($line['count(*)']!=1)
			{
				$echec='yes';
			}
			else
			{ 
				$_SESSION['login']=$login;
				$sql2 = "select id from users where login='$login' and mdp='$mdp';";
				$query = $pdo->prepare($sql2);
				$query->execute();
	
				while($line=$query->fetch()) 
				{
					$_SESSION['id']=$line['id'];
				}
				$sql3 = "select admin from users where login='$login' and mdp='$mdp';";
				$query = $pdo->prepare($sql3);
				$query->execute();
	
				while($line=$query->fetch()) 
				{
					if ($line['admin']==1)
						$_SESSION['admin']=1;
				}
				header("location:index.php");
			}
		}		
}
?>
