<?php
	/* PHP file for database queries for user
	 * Calls connect.php to connect to MySQL database 
	 * Team 9, CMPE 226, SJSU, Fall 2014
	 * Xiaoli Jiang, Jennifer Wu
	 */
	function get_query() {
		//database connection
		include 'connect.php';
		$user_id = $_SESSION['user_id'];

		$sql = "SELECT * from User_Favs natural join Venue where user_id=$user_id";
		$results = mysqli_query($con, $sql);
		$num_rows = $results->num_rows;

		if ($num_rows > 0) {
			while($i = mysqli_fetch_array($results)) {
				echo "<div class='well'>
						<div class=''>
							<div class='row'>";
				$v_id = $i['Venue_ID'];
                $v_FS_ID = $i['FS_ID'];
				$u_date = $i['Date_Visiting'];
				$v_name = $i['Name'];
				$v_add = $i['Address'];
				$v_zip = $i['ZipCode'];
				$v_type = $i['Venue_Type'];
				echo "<div class='col-sm-12 answer'><a href='venuedetails.php?FS_ID=$v_FS_ID'><h4><span class='v_name'>$v_name</span></a>";
				if ($u_date != null) {
					echo "<br>Date: <span class='u_date'>$u_date</span></h4></div>";
				}
				else {
					echo "</h4></div>";
				}

				if ($v_add != null && $v_zip != null) {
					//echo "<div class='col-sm-3 header'><b>Address</b></div>";
					echo "<div class='col-sm-12 answer'>$v_add</div>";	
					//echo "<div class='col-sm-3 header'><b>Zip</b></div>";
					echo "<div class='col-sm-12 answer'>$v_zip</div>";
				}
				else {
					//echo "<div class='col-sm-3 header'><b>Address</b></div>";
					echo "<div class='col-sm-12 answer'><i>No Address Listed</i></div>";	
				}
				//echo "<div class='col-sm-3 header'><b>Type</b></div>";
				echo "<div class='col-sm-12 answer'>$v_type</div>
					</div>
					</div>";//end row div
	
				//echo "<td>" . $v_lat . "</td>";
				//echo "<td>" . $v_long . "</td>";
				//echo "<td>" . $rating . "</td>";
				//echo "<td>" . $v_likes . "</td>";
				echo "</div>";
			}
		}
		else {
			echo "<div class='row bg-info row-result'>No favorite FourU Venues yet!
					</div>";
            /*echo "<div class='col-sm-12 answer'><a href=''><h4><span class='v_name'>Test Resutrant</span></a>";
            echo "<br><span class='u_date'>2014-10-20</span></h4></div>";
            echo "<div class='col-sm-12 answer'><a href=''><h4><span class='v_name'>Test Resutrant2</span></a>";
            echo "<br><span class='u_date'>2014-10-25</span></h4></div>";*/

            //test data

		}
		mysqli_close($con);//close connection to db
	}//end function get_query()

	function get_user() {
		//database connection
		include 'connect.php';
		$user_id = $_SESSION['user_id'];

		$sql = "SELECT * FROM User join accounts on user_id=login_id where user_id=$user_id;";
		$results = mysqli_query($con, $sql);
		
		if(mysqli_num_rows($results) == 1) {
			$row = mysqli_fetch_assoc($results);
			$name = $row["Name"];
			$zipcode = $row["ZipCode"];
			$email = $row["email"];
			$password = $row["password"];

			echo "<div class='row'>
				<div class='col-sm-3'><h4>Name</h4></div>
				<div class='col-sm-9'><h4 class='answer'>$name 
					<i class='fa fa-pencil name'></i></a>
				</h4></div></div>";
			echo "<div class='row'>
				<div class='col-sm-3'><h4>Zipcode</h4></div>
				<div class='col-sm-9'><h4 class='answer'>$zipcode
					<i class='fa fa-pencil zipcode'></i></a>
				</h4></div></div>";
			echo "<div class='row'>
				<div class='col-sm-3'><h4>Email</h4></div>
				<div class='col-sm-9'><h4 class='answer'>$email
					<i class='fa fa-pencil email'></i></a>
				</h4></div></div>";
			echo "<div class='row'>
				<div class='col-sm-3'><h4>Password</h4></div>
				<div class='col-sm-9'><h4 class='answer'>Change Password
					<i class='fa fa-pencil password'></i>
				</h4></div></div>";
			
		}
		else {
			echo "<p>Error with database</p>";
		}
		mysqli_close($con);//close connection to db
	}//end function get_user()

?>