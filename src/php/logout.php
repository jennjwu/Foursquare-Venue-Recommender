<?php 
	/*Script to logout*/
	session_start();
	session_destroy();
	//var_dump($_SESSION);
	header("location: ../index.php");
?>