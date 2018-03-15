<?php 
/*

	$dbHost = "localhost";	//host (server) ip and port no.  
	
	$dbUser = "root";	//Username of the same ip
	
	$dbPass = "";	//password if applicable for the username
	
	$dbDatabase ="piyush";	//database name
	
	$db = mysql_connect($dbHost,$dbUser,$dbPass)or die("Error connecting to database.");
	if (!mysql_set_charset('utf8', $db)) {
		echo "Error: Unable to set the character set.\n";
		exit;
	}
	
	mysql_select_db($dbDatabase, $db)or die("Couldn't select the database.");	//select the given database
*/

	$dbHost = "db.soic.indiana.edu";	//host (server) ip and port no.  
	$dbUser = "p565f17_spanchal";	//Username of the same ip
	$dbPass = "my+sql=p565f17_spanchal";	//password if applicable for the username
	$dbDatabase ="p565f17_spanchal";	//database name
	
	$db = mysqli_connect($dbHost,$dbUser,$dbPass,$dbDatabase)or die("Error connecting to database.");
	if (!mysqli_set_charset($db, "utf8")) {
		echo "Error: Unable to set the character set.\n";
		exit;
	}
	
	//mysqli_select_db($db, $dbDatabase)or die("Couldn't select the database.");	//select the given database
?>