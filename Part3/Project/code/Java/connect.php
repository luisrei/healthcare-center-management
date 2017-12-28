<?php

	$host="db.ist.utl.pt";	// MySQL is hosted in this machine
	$user="ist1xxxxx";	// <== replace istxxx by your IST identity
	$password="xxxxxxxx";	// <== paste here the password assigned by mysql_reset
	$dbname = $user;	// Do nothing here, your database has the same name as your username.

 
	$connection = new PDO("mysql:host=" . $host. ";dbname=" . $dbname, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
?>