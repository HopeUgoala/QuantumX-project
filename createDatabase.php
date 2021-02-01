<?php
$link = mysqli_connect("localhost", "root", "", "xopes");
if (!$link) {
    die("Connection failed: " . mysqli_connect_error());
}

// Create database
$sql = "CREATE DATABASE IF NOT EXISTS xopes";

mysqli_query($link, $sql);


?>