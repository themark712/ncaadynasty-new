<?php
function dbconnect()
{
	//$servername = "fdb1020.awardspace.net";
	$servername="127.0.0.1";
	$dbname = "1576537_mydb";
	$username = "root";
	$password = "";

	// Create connection
	$cn = new mysqli($servername, $username, $password, $dbname);

	return $cn;
}
?>