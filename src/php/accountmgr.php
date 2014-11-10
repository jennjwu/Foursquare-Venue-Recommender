<?php
	/* PHP file for user mgmt
	 * Calls connect.php to connect to MySQL database 
	 * Team 9, CMPE 226, SJSU, Fall 2014
	 * Xiaoli Jiang, Jennifer Wu
	 */
	
  session_start();
	//database connection
	include 'connect.php';

  if (isset($_POST['user_name'])){
      $user_name = filter_var($_POST['user_name'], FILTER_SANITIZE_STRING);

      $sql = "UPDATE User set Name='$user_name' where user_id=".$_SESSION['user_id'].";";
      echo $sql;
      if (!mysqli_query($con, $sql)) {
          echo "<p class=text-center text-danger'>System Error</p>";
      }
      else {
          header("location: ../account.php");
      }
  }
  else if (isset($_POST['zip_code'])) {
      $user_zip = filter_var($_POST['zip_code'], FILTER_SANITIZE_STRING);

      $sql = "UPDATE User set Zipcode=$user_zip where user_id=".$_SESSION['user_id'].";";
      if (!mysqli_query($con, $sql)) {
          echo "<p class=text-center text-danger'>System Error</p>";
      }
      else {
          header("location: ../account.php");
      }
  }
  else if (isset($_POST['email'])) {
      $user_email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

      $sql = "UPDATE Accounts set email='$user_email' where login_id=".$_SESSION['user_id'].";";
      if (!mysqli_query($con, $sql)) {
          echo "<p class=text-center text-danger'>System Error</p>";
      }
      else {
          header("location: ../account.php");
      }
  }
  else if (isset($_POST['old_pw']) && isset($_POST['new_pw1']) && isset($_POST['new_pw2'])) {
      $old_pw = filter_var($_POST['old_pw'], FILTER_SANITIZE_STRING);
      $new_pw = filter_var($_POST['new_pw1'], FILTER_SANITIZE_STRING);

      $sql = "Select password from Accounts where login_id=".$_SESSION['user_id'].";";
      $results = mysqli_query($con,$sql);
      if (mysqli_num_rows($results) != 1) {
          echo "<p class=text-center text-danger'>System Error</p>";
      }
      else {
          $row = mysqli_fetch_assoc($results);
          $c_pw = $row["password"];

          if ($old_pw == $c_pw){
              //change ok
              $sql = "UPDATE Accounts set password='".$new_pw."' where login_id=".$_SESSION['user_id'].";";
              if (!mysqli_query($con, $sql)) {
                  echo "<p class=text-center text-danger'>System Error</p>";
              }
              else {
                  header("location: ../account.php");
              }
          }
          else {
              //current password incorrect
              header("location: ../account.php?error=pw");
          }

      }
  }
  else {
      echo "something else";
  }


?>