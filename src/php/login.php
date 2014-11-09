<?php
	/* PHP file for login page
	 * Calls connect.php to connect to MySQL database 
	 * Team 9, CMPE 226, SJSU, Fall 2014
	 * Xiaoli Jiang, Jennifer Wu
	 */
	
	//database connection
	include 'connect.php';


  $error = false; //for invalid sign in
  $notfound = false; //for not signed up

  if (isset($_POST['email']) && isset($_POST['password'])){
      // Sanitize incoming username and password
      $user_email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
      $user_password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);

      //query database for matching password
      $sql = "SELECT * from accounts WHERE email='".$user_email."';";
      //echo $sql;
      $results = mysqli_query($con, $sql);
      //echo mysqli_num_rows($results);

      if (mysqli_num_rows($results) == 1) {
        //user found
        $row = mysqli_fetch_assoc($results);
        $login_id = $row["login_id"];
        $pw = $row["password"];

        if ($pw == $user_password) {
            $error = false;
            $notfound = false;
            echo "<p>Authenticated!</p>";
            $stmt = "UPDATE Accounts SET last_login = now() where login_id = $login_id;";
            if (!mysqli_query($con, $stmt)) {
                echo "<p class=text-center text-danger'>System Error</p>";
            }
            else {
                $sql = "SELECT name from User where user_id=$login_id;";
                $results = mysqli_query($con,$sql);
                if (mysqli_num_rows($results) != 1) {
                    echo "<p class=text-center text-danger'>System Error</p>";
                }
                else {
                    $row = mysqli_fetch_assoc($results);
                    $user_name = $row["name"];
                    session_start();
                    $_SESSION['user_id'] = $login_id;
                    $_SESSION['name'] = $user_name;  
                }
            }
            header('Location: userhome.php');
        }
        else {
            $error = true;
            $notfound = false;
            //echo "<p class='text-center'>Login Failed.</p>";
        }
      }
      else {
          $notfound = true;
          $error = false; //not invalid sign in
      }
  }


?>