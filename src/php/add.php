<?php 
	/*Script to add new venue to favs*/
	session_start();
	
	//database connection
	include 'connect.php';

	$no_date = false;
	$venue_f_id = $_POST['FS_ID'];
	$user_id = $_SESSION['user_id'];

	//find venue_id first
	$sql = "SELECT venue_id from venue where fs_id='$venue_f_id';";
	$results = mysqli_query($con,$sql);
	if (mysqli_num_rows($results) != 1) {
        echo "<p class=text-center text-danger'>System Error</p>";
    }
    else {
        $row = mysqli_fetch_assoc($results);
        $venue_id = $row["venue_id"];
        //echo $venue_id;
    }

    //form work
	if (isset($_POST['date_visit'])){
		$date_visit = $_POST['date_visit'];
		//echo $date_visit;

        //check if venue+user already exist
        $sql = "select * from user_favs where user_id=$user_id and venue_id=$venue_id";
        $results = mysqli_query($con,$sql);
        if (mysqli_num_rows($results) > 0) {
            //update instead of insert
            $sql = "Update User_Favs set date_visiting='$date_visit' where user_id=$user_id and Venue_ID=$venue_id;";
			if (!mysqli_query($con, $sql)) {
	            echo "<p class=text-center text-danger'>System Error</p>";
	        }
	        else {
	        	header("location: ../userhome.php");
	        }

        }
        else {
            $sql = "INSERT into User_Favs set user_id=$user_id, Venue_ID=$venue_id, date_visiting='$date_visit'";
			if (!mysqli_query($con, $sql)) {
	            echo "<p class=text-center text-danger'>System Error</p>";
	        }
	        else {
	        	header("location: ../userhome.php");
	        }
        }

	}
	else {
		//no date given - can still add
		//check if venue+user already exist
        $sql = "select * from user_favs where user_id=$user_id and venue_id=$venue_id";
        $results = mysqli_query($con,$sql);
        if (mysqli_num_rows($results) == 0) {
        	//don't already exist - so add
           	$sql = "INSERT into User_Favs set user_id=$user_id, Venue_ID=$venue_id";
			if (!mysqli_query($con, $sql)) {
	            echo "<p class=text-center text-danger'>System Error</p>";
	        }
	        else {
	        	header("location: ../userhome.php");
	        }
        }
	}

	//header("location: ../userhome.php");
?>