<!DOCTYPE html>
<html>

   <head>
   <!-- 
   	Venue Recommender Search Page
   	Cmpe 226
   	Team 9
   	Xiaoli Jiang
   	Jennifer Wu
    -->

	<meta charset="UTF-8" />
	<title>Recommender</title>
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" />
   </head>


   <body>
	<div class='container'>
	<header>
	    <h1 class='text-center'>Venue Recommender</h1>
	</header>

	<p class='text-center'>Pick a Criteria!</p>
	
		<?php
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

		//set selection of form
		$select1 = '';
		$select2 = '';
		$select3 = '';
		$select4 = '';
		$select5 = '';
		$select6 = '';
		$select7 = '';
		$select8 = '';
		if (isset($_POST['venue_selection'])) {
			$post_venue_selection = $_POST['venue_selection'];
			switch($post_venue_selection) {
				case 'popular':
					$select1 = "checked='checked'";
					break;
				case 'special_event':
					$select2 = "checked='checked'";
					break;
				case 'mingle':
					$select3 = "checked='checked'";
					break;
				case 'economical':
					$select4 = "checked='checked'";
					break;
				case 'study':
					$select5 = "checked='checked'";
					break;
				case 'large_group':
					$select6 = "checked='checked'";
					break;
				case 'random':
					$select7 = "checked='checked'";
					break;
				case 'all':
					$select8 = "checked='checked'";
					break;
			}
		}
		?>
		
			<form class='form text-center' method='POST' name='venueform' action='sorter.php'>
				<div class='btn-group' data-toggle='buttons'>
					<label class='btn btn-primary'><input type='radio' name='venue_selection' value='popular' 
					<?php echo $select1; ?>
					>Popular
					</label>
					<label class='btn btn-primary'><input type='radio' name='venue_selection' value='special_event'
					<?php echo $select2; ?>
					>Special Events
					</label>
					<label class='btn btn-primary'><input type='radio' name='venue_selection' value='mingle'
					<?php echo $select3; ?>
					>Mingle
					</label>
					<label class='btn btn-primary'><input type='radio' name='venue_selection' value='economical'
					<?php echo $select4; ?>
					>Economical
					</label>
					<label class='btn btn-primary'><input type='radio' name='venue_selection' value='study'
					<?php echo $select5; ?>
					>Study
					</label>
					<label class='btn btn-primary'><input type='radio' name='venue_selection' value='large_group'
					<?php echo $select6; ?>
					>Large Group
					</label>
					<label class='btn btn-primary'><input type='radio' name='venue_selection' value='random'
					<?php echo $select7; ?>
					>Random
					</label>
					<label class='btn btn-primary'><input type='radio' name='venue_selection' value='all'
					<?php echo $select8; ?>
					>All
					</label>
				</div>
				<br><br>
				<input type='submit' class='btn btn-success btn-large' value='Recommend!'>
			</form>
		
		<div id='results'>
		<?php
		//function to get queries based on criteria
		function get_query($case) {
			//database settings
			$host="localhost";
			$username="root";
			$password="root";
			$database="FS_Recommender";
			//connect to database
			$con =mysqli_connect($host,$username,$password,$database);

			switch($case) {
				case 'popular':
					$sql = "SELECT * FROM Venue natural join Amenities where rating > 7 and likes > 50;";
					echo "<p>Popular</p>";
					break;
				case 'special_event':
					$sql = "SELECT * FROM Venue natural join Amenities where reservations = 'Y' and events_count = 0;";
					echo "<p>Special Event</p>";
					break;
				case 'mingle':
					$sql = "SELECT * FROM Venue natural join Amenities where alcohol='Y' or menus like '%Happy Hour%' or Venue_type like '%Bar%';";
					echo "<p>Mingle</p>";
					break;
				case 'economical':
					$sql = "SELECT * FROM Venue natural join Amenities where price='$';";
					echo "<p>Economical</p>";
					break;
				case 'study':
					$sql = "SELECT * FROM Venue natural join Amenities where (venue_type like '%Coffee%' or venue_type like '%Cafe%') and wifi = 'Y';";
					echo "<p>Study</p>";
					break;
				case 'large_group':
					$sql = "SELECT * FROM Venue natural join Amenities where reservations = 'Y' or venue_type like '%Restaurant%';";
					echo "<p>Large Group</p>";
					break;
				case 'random':
					echo "<p>Random</p>";
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
					echo "<p>All</p>";
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
			echo "</div>";		
		}//end function get_query()

		if (isset($post_venue_selection)) {
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
			echo "<br><br><p class='text-center'><b>Please select an outing type!</b></p>";
		}

		?>
		</div>
	</div>
	</body>

	<footer class='col-md-12 text-center'>
		<hr>
		&copy; Team 9, CMPE 226, Fall 2014, SJSU<br>
		&copy; Foursquare Data obtained through the free API
   	</footer>


</html>