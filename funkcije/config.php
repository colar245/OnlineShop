<?php 
	//database connection
$host = "localhost";
$user = "admin";
$pass = "admin";
$db_name = "internet_prodavnica";

$connection = mysqli_connect($host, $user, $pass, $db_name);
if (mysqli_connect_error()) {
	echo "Neuspela konekcija ". mysqli_connect_error();
}

 ?>