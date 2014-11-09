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
				echo "<div class='row bg-info row-result'>
						<div class='col-sm-10'>
							<div class='row'>";
				$v_id = $i['Venue_ID'];
				$u_date = $i['Date_Visiting'];
				$v_name = $i['Name'];
				$v_add = $i['Address'];
				$v_zip = $i['ZipCode'];
				$v_type = $i['Venue_Type'];
				echo "<div class='col-sm-12 answer'><h4>$v_name";
				if ($u_date != null) {
					echo "<br>Date: $u_date</h4></div>";
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
				echo "<div class='col-sm-2'><br>
					<a href='#'><i class='fa fa-angle-double-right fa-5x'></i></a>
					</div>";
	
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
		}
		mysqli_close($con);//close connection to db
	}//end function get_query()
?>