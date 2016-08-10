<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tutor";

// connect to the database
$mysqli = new mysqli($servername, $username, $password, $dbname) or die ("Could not connect to mysql because ".mysqli_error());
mysqli_query($mysqli,"SET NAMES 'utf8'");
	mysqli_select_db($mysqli,$dbname)  //select the database
	or die ("Could not select to mysql because ".mysqli_error());

?>