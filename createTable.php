<?php

$link = mysqli_connect("localhost", "root", "", "xopes");
// Check connection
if (!$link) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "CREATE TABLE IF NOT EXISTS `user2` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `username` varchar(50) NOT NULL,
 `email` varchar(50) NOT NULL,
 `password` varchar(50) NOT NULL,
 PRIMARY KEY (`id`)
 )";

mysqli_query($link, $sql);
    

?>

