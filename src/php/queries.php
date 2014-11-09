<?php
	/* PHP file for database queries by criteria
	 * Calls connect.php to connect to MySQL database 
	 * Team 9, CMPE 226, SJSU, Fall 2014
	 * Xiaoli Jiang, Jennifer Wu
	 */
	function get_query($case) {
		//database connection
		include 'connect.php';

		switch($case) {
			case 'popular':
				$sql = "SELECT * FROM Venue natural join Amenities where rating > 7 and likes > 50;";
				break;
			case 'special_event':
				$sql = "SELECT * FROM Venue natural join Amenities where reservations = 'Y' and events_count = 0;";
				break;
			case 'mingle':
				$sql = "SELECT * FROM Venue natural join Amenities where alcohol='Y' or menus like '%Happy Hour%' or Venue_type like '%Bar%';";
				break;
			case 'economical':
				$sql = "SELECT * FROM Venue natural join Amenities where price='$';";
				break;
			case 'study':
				$sql = "SELECT * FROM Venue natural join Amenities where (venue_type like '%Coffee%' or venue_type like '%Cafe%') and wifi = 'Y';";
				break;
			case 'large_group':
				$sql = "SELECT * FROM Venue natural join Amenities where reservations = 'Y' or venue_type like '%Restaurant%';";
				break;
			case 'random':
				/*For random picker logic*/
				$sql1 = "SELECT Venue_ID from Venue"; //select all venue IDs in db
				$results1 = mysqli_query($con, $sql1);
				$num_ent = $results1->num_rows; //determine how many IDs there are
				$numbers = range(1,$num_ent);
				shuffle($numbers);

				$numbers = array_slice($numbers,0,5); //pick five numbers

				$where_statement = "";
				foreach($numbers as $rand_num) {
					$where_statement = $where_statement . "Venue_ID like '_%$rand_num' or ";
				}
				$where_statement = $where_statement . "Venue_ID=0 limit 5";//to end where st
				//echo $where_statement;

				$sql = "SELECT * from Venue where $where_statement;";				
				break;
			case 'all':
				$sql = "SELECT * from Venue natural join Amenities;";
				break;
		}
		$results = mysqli_query($con, $sql);
		$num_rows = $results->num_rows;
		
		if ($num_rows > 0) {
			while($i = mysqli_fetch_array($results)) {
				echo "<div class='well'>
						<div class=''>
							<div class='row'>";
				$v_id = $i['Venue_ID'];
				$v_name = $i['Name'];
				$v_add = $i['Address'];
				$v_zip = $i['ZipCode'];
				$v_lat = $i['Latitude'];
				$v_long = $i['Longitude'];
				$v_type = $i['Venue_Type'];
				$rating = $i['Rating'];
				$v_likes = $i['Likes'];
				//echo "<div class='col-sm-3 header'><b>Venue ID</b></div>";
				//echo "<div class='col-sm-9 answer'>$v_id</div>";
				//echo "<div class='col-sm-3 header'><b>Name</b></div>";
				echo "<div class='col-sm-12 '><a href='#'><h4>$v_name</h4></a></div>";
				if ($v_add != null && $v_zip != null) {
					//echo "<div class='col-sm-3 header'><b>Address</b></div>";
					echo "<div class='col-sm-12 '>$v_add</div>";
					//echo "<div class='col-sm-3 header'><b>Zip</b></div>";
					echo "<div class='col-sm-12 '>$v_zip</div>";
				}
				else {
					//echo "<div class='col-sm-3 header'><b>Address</b></div>";
					echo "<div class='col-sm-12 '><i>No Address Listed</i></div>";
				}
				//echo "<div class='col-sm-3 header'><b>Type</b></div>";
				echo "<div class='col-sm-12 '>$v_type</div>";//end row div
				echo "</div>
					</div>";

				//echo "<td>" . $v_lat . "</td>";
				//echo "<td>" . $v_long . "</td>";
				//echo "<td>" . $rating . "</td>";
				//echo "<td>" . $v_likes . "</td>";
				echo "</div>";

                //hidden lat and lng
                echo "<div class='hidden_lat_lng'>
                        <div class='lat'>$v_lat</div>
                        <div class='long'>$v_long</div>

                        </div>";


			}
		}//end if
		else {
			echo "<p>No venues match your criteria.</p>";
		}
		mysqli_close($con);//close connection to db
	}//end function get_query()

	function call_queries() {
		if (isset($_GET['category'])) {
			$post_venue_selection = $_GET['category'];
			//echo $post_venue_selection;
			//determine which list to show based on selection
			switch ($post_venue_selection) {
				case 'popular':
					get_query('popular');
					break;
				case 'special_event':
					get_query('special_event');
					break;
				case 'mingle':
					get_query('mingle');
					break;
				case 'economical':
					get_query('economical');
					break;
				case 'study':
					get_query('study');
					break;
				case 'large_group':
					get_query('large_group');
					break;
				case 'random':
					get_query('random');
					break;
				case 'all':
					get_query('all');
					break;
			}//end switch
		}//end if isset
		else {
			echo "<div class='text-danger'><h5>Please select an outing type!</h5></div>";
			
		}
	}

?>