<?php

session_start();


	$sever ="localhost";
    $user ="root";
    $password ="";
    $databaseName ="xopes";
		
$link =mysqli_connect($sever,$user,$password,$databaseName);

$id=$_REQUEST['id'];
$quantum = $_SESSION['site'].$_SESSION['line'];

$query = "DELETE FROM `$quantum` WHERE `$quantum`.`id` = '$id'";

$result = mysqli_query($link,$query) or die ( mysqli_error());	

if ($result)
{
	
mysqli_query($link,$query) or die ( mysqli_error());
 
}

header("Location: loggedinpage.php"); 

?>