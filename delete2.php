<?php
session_start();
$link = mysqli_connect("localhost", "root", "", "xopes");
$quantum = $_SESSION["site"].$_SESSION["line"];

$id = $_REQUEST['id'];


$query = "DELETE FROM site_infos WHERE id = $id"; 
$quey = "DROP TABLE `$quantum`";
$result = mysqli_query($link, $query) or die ( mysqli_error());
$result2 = mysqli_query($link, $quey) or die (mysqli_error());
header("Location: loggedinpage.php"); 

?>
