<?php
// Connexion a la base de donnees
$host='localhost';
$database='todo';
$user='root';
$password='root';

$strCon = "mysql:host=$host;dbname=$database"; 
$arrExtraParam= array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"); 
$pdo = new PDO($strCon, $user, $password, $arrExtraParam); 
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>
