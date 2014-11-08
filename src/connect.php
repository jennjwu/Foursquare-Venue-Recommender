<?php 
	/* PHP file for database connection
	 * Connects to a MySQL database 
	 * Team 9, CMPE 226, SJSU, Fall 2014
	 * Xiaoli Jiang, Jennifer Wu
	 */

	//database settings
	$host="localhost";
	$username="root";
	$password="root";
	$database="FS_Recommender";

	//connect to database
	$con =mysqli_connect($host,$username,$password,$database);
	if (mysqli_connect_errno()) {
		echo "Failed to connect to MySQL DB: " . mysqli_connect_error();
	}
?>