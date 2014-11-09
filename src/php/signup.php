<?php 
	/* PHP file for signup page
	 * Calls connect.php to connect to MySQL database 
	 * Team 9, CMPE 226, SJSU, Fall 2014
	 * Xiaoli Jiang, Jennifer Wu
	 */

	//database connection
	include 'connect.php';

	$pw_mismatch = false;
	$existing = false;

	if (isset($_POST['user_name']) && isset($_POST['zipcode']) && isset($_POST['email']) && 
			isset($_POST['password']) && isset($_POST['password_confirm']) ){
		
		$user_name = filter_var($_POST['user_name'], FILTER_SANITIZE_STRING);
		$user_zip = filter_var($_POST['zipcode'], FILTER_SANITIZE_STRING);
		$user_email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
  		$user_password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
  		$user_pw2 = filter_var($_POST['password_confirm'], FILTER_SANITIZE_STRING);
		
		if ($user_password != $user_pw2) {
			$pw_mismatch = true;
		}
		else {//passwords match
			//add check to see if user with same email already exists
			$sql = "SELECT * from accounts where email='".$user_email."';";
			$results = mysqli_query($con,$sql);
			if (mysqli_num_rows($results) > 0) {
				$existing = true;
				return; //skip rest of this
			}

      		//add new entry to accounts table
      		$stmt = "INSERT INTO accounts (email, password, last_login) VALUES('".$user_email."','".
      			 $user_password."', now());";
      		//echo $stmt;
      		if (!mysqli_query($con, $stmt)) {
                echo "<p class=text-center text-danger'>System Error 1</p>";
            }
            else {
            	$sql = "SELECT login_id from accounts where email='".$user_email."';";
            	$results = mysqli_query($con,$sql);
                if (mysqli_num_rows($results) != 1) {
                    echo "<p class=text-center text-danger'>System Error 2</p>";
                }
                else {
                	//get user_id (auto-increment from accounts table)
                    $row = mysqli_fetch_assoc($results);
                    $user_id = $row["login_id"];

                    //add new entry into user table
                    $stmt = "INSERT INTO user (user_id, name, zipcode) VALUES($user_id, 
                    	'".$user_name."', $user_zip);";
                    if (!mysqli_query($con, $stmt)) {
		                echo "<p class=text-center text-danger'>System Error</p>";
		            }
		            else {
		            	echo "<p>Success! Logging you in now.</p>";
		            	session_start();
	                    $_SESSION['user_id'] = $user_id;
	                    $_SESSION['name'] = $user_name;  
		            	header("location: index.php#about");
		            }
                }
            }
		}//end else for pw match
	}//end isset

?>