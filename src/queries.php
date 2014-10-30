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
				echo "<div class='callout callout-info'><h5>Popular</h5>";
				break;
			case 'special_event':
				$sql = "SELECT * FROM Venue natural join Amenities where reservations = 'Y' and events_count = 0;";
				echo "<div class='callout callout-info'><h5>Special Event</h5>";
				break;
			case 'mingle':
				$sql = "SELECT * FROM Venue natural join Amenities where alcohol='Y' or menus like '%Happy Hour%' or Venue_type like '%Bar%';";
				echo "<div class='callout callout-info'><h5>Mingle</h5>";
				break;
			case 'economical':
				$sql = "SELECT * FROM Venue natural join Amenities where price='$';";
				echo "<div class='callout callout-info'><h5>Economical</h5>";
				break;
			case 'study':
				$sql = "SELECT * FROM Venue natural join Amenities where (venue_type like '%Coffee%' or venue_type like '%Cafe%') and wifi = 'Y';";
				echo "<div class='callout callout-info'><h5>Study</h5>";
				break;
			case 'large_group':
				$sql = "SELECT * FROM Venue natural join Amenities where reservations = 'Y' or venue_type like '%Restaurant%';";
				echo "<div class='callout callout-info'><h5>Large Group</h5>";
				break;
			case 'random':
				echo "<div class='callout callout-info'><h5>Random</h5>";
				/*For random picker logic*/
				$sql1 = "SELECT Venue_ID from Venue"; //select all venue IDs in db
				$results1 = mysqli_query($con, $sql1);
				$num_ent = $results1->num_rows; //determine how many IDs there are
				$numbers = range(1,$num_ent);
				shuffle($numbers);

				$numbers = array_slice($numbers,0,5); //pick five

				$where_statement = "";
				foreach($numbers as $rand_num) {
					$where_statement = $where_statement . "Venue_ID like '_%$rand_num' or ";
				}
				$where_statement = $where_statement . "Venue_ID=0";//to end where st
				//echo $where_statement;

				$sql = "SELECT * from Venue where $where_statement;";				
				break;
			case 'all':
				$sql = "SELECT * from Venue natural join Amenities;";
				echo "<div class='callout callout-info'><h5>All</h5>";
				break;
		}

		$results = mysqli_query($con, $sql);
		$num_rows = $results->num_rows;
		
		if ($num_rows > 0) {
			echo "<table class='table table-hover'>";
			echo "<thead>
					<tr>
						<th>Venue ID</th>
						<th>Venue Name</th>
						<th>Address</th>
						<th>Zipcode</th>
						<th>Lat</th>
						<th>Long</th>
						<th>Type</th>
						<th>Rating</th>
						<th>Likes</th>
					</tr>
				  </thead>";
			while($i = mysqli_fetch_array($results)) {
				echo "<tr>";
				$v_id = $i['Venue_ID'];
				$v_name = $i['Name'];
				$v_add = $i['Address'];
				$v_zip = $i['ZipCode'];
				$v_lat = $i['Latitude'];
				$v_long = $i['Longitude'];
				$v_type = $i['Venue_Type'];
				$rating = $i['Rating'];
				$v_likes = $i['Likes'];
				echo "<td>" . $v_id . "</td>";
				echo "<td>" . $v_name . "</td>";
				echo "<td>" . $v_add . "</td>";
				echo "<td>" . $v_zip . "</td>";
				echo "<td>" . $v_lat . "</td>";
				echo "<td>" . $v_long . "</td>";
				echo "<td>" . $v_type . "</td>";
				echo "<td>" . $rating . "</td>";
				echo "<td>" . $v_likes . "</td>";
				echo "</tr>";
			}
			echo "</table>";
		}//end if
		else {
			echo "<p>No venues match your criteria.</p>";
		}
		echo "</div></div>";
		mysqli_close($con);//close connection go db
	}//end function get_query()

	function call_queries() {
		if (isset($_POST['venue_selection'])) {
			$post_venue_selection = $_POST['venue_selection'];
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
			echo "<div class='callout callout-danger'><h5>Please select an outing type!</h5></div>";
			
		}
	}

?>