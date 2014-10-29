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
	<link href="" rel="stylesheet" type="text/css" />
   </head>


   <body>
	<header>
	    <h1>Venue Recommender</h1>
	</header>

	<p>Pick a Criteria!</p>
	<div>
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

		$string = file_get_contents("test.json");
		//echo $string;
		$json_arr = json_decode($string);
		//var_dump($json_arr);
		//echo "<br/><br/>";

		/*For random picker logic*/
		$num_ent = sizeof($json_arr);
		$numbers = range(1,$num_ent);
		shuffle($numbers);
		$numbers = array_slice($numbers,0,5); //pick five

		//criteria arrays
		$popular = array();
		$special = array();
		$mingle = array();
		$economical = array();
		$study = array();
		$large_group = array();
		$random = array();

		//check if outing type selected
		if (isset($_POST['venue_selection'])) {
			$post_venue_selection = $_POST['venue_selection'];
			switch($post_venue_selection) {
				case 'popular':
					echo "<form method='POST' name='venueform' action='sorter.php'> 
					<p>
					<input type='radio' name='venue_selection' value='popular' checked='checked'>Popular
					</p>
					<p>
					<input type='radio' name='venue_selection' value='special_event'>Special Events
					</p>
					<p>
					<input type='radio' name='venue_selection' value='mingle'>Mingle
					</p>
					<p>
					<input type='radio' name='venue_selection' value='economical'>Economical
					</p>
					<p>
					<input type='radio' name='venue_selection' value='study'>Study
					</p>
					<p>
					<input type='radio' name='venue_selection' value='large_group'>Large Group
					</p>
					<p>
					<input type='radio' name='venue_selection' value='random'>Random
					</p>
					<p>
					<input type='radio' name='venue_selection' value='all'>All
					</p>
					<input type='submit' value='Recommend!'><br>
					</form>";
					break;
				case 'special_event':
					echo "<form method='POST' name='venueform' action='sorter.php'> 
					<p>
					<input type='radio' name='venue_selection' value='popular'>Popular
					</p>
					<p>
					<input type='radio' name='venue_selection' value='special_event' checked='checked'>Special Events
					</p>
					<p>
					<input type='radio' name='venue_selection' value='mingle'>Mingle
					</p>
					<p>
					<input type='radio' name='venue_selection' value='economical'>Economical
					</p>
					<p>
					<input type='radio' name='venue_selection' value='study'>Study
					</p>
					<p>
					<input type='radio' name='venue_selection' value='large_group'>Large Group
					</p>
					<p>
					<input type='radio' name='venue_selection' value='random'>Random
					</p>
					<p>
					<input type='radio' name='venue_selection' value='all'>All
					</p>
					<input type='submit' value='Recommend!'><br>
					</form>";
					break;
				case 'mingle':
					echo "<form method='POST' name='venueform' action='sorter.php'> 
					<p>
					<input type='radio' name='venue_selection' value='popular'>Popular
					</p>
					<p>
					<input type='radio' name='venue_selection' value='special_event'>Special Events
					</p>
					<p>
					<input type='radio' name='venue_selection' value='mingle' checked='checked'>Mingle
					</p>
					<p>
					<input type='radio' name='venue_selection' value='economical'>Economical
					</p>
					<p>
					<input type='radio' name='venue_selection' value='study'>Study
					</p>
					<p>
					<input type='radio' name='venue_selection' value='large_group'>Large Group
					</p>
					<p>
					<input type='radio' name='venue_selection' value='random'>Random
					</p>
					<p>
					<input type='radio' name='venue_selection' value='all'>All
					</p>
					<input type='submit' value='Recommend!'><br>
					</form>";
					break;
				case 'economical':
					echo "<form method='POST' name='venueform' action='sorter.php'> 
					<p>
					<input type='radio' name='venue_selection' value='popular'>Popular
					</p>
					<p>
					<input type='radio' name='venue_selection' value='special_event'>Special Events
					</p>
					<p>
					<input type='radio' name='venue_selection' value='mingle'>Mingle
					</p>
					<p>
					<input type='radio' name='venue_selection' value='economical' checked='checked'>Economical
					</p>
					<p>
					<input type='radio' name='venue_selection' value='study'>Study
					</p>
					<p>
					<input type='radio' name='venue_selection' value='large_group'>Large Group
					</p>
					<p>
					<input type='radio' name='venue_selection' value='random'>Random
					</p>
					<p>
					<input type='radio' name='venue_selection' value='all'>All
					</p>
					<input type='submit' value='Recommend!'><br>
					</form>";
					break;
				case 'study':
					echo "<form method='POST' name='venueform' action='sorter.php'> 
					<p>
					<input type='radio' name='venue_selection' value='popular'>Popular
					</p>
					<p>
					<input type='radio' name='venue_selection' value='special_event'>Special Events
					</p>
					<p>
					<input type='radio' name='venue_selection' value='mingle'>Mingle
					</p>
					<p>
					<input type='radio' name='venue_selection' value='economical'>Economical
					</p>
					<p>
					<input type='radio' name='venue_selection' value='study' checked='checked'>Study
					</p>
					<p>
					<input type='radio' name='venue_selection' value='large_group'>Large Group
					</p>
					<p>
					<input type='radio' name='venue_selection' value='random'>Random
					</p>
					<p>
					<input type='radio' name='venue_selection' value='all'>All
					</p>
					<input type='submit' value='Recommend!'><br>
					</form>";
					break;
				case 'large_group':
					echo "<form method='POST' name='venueform' action='sorter.php'> 
					<p>
					<input type='radio' name='venue_selection' value='popular'>Popular
					</p>
					<p>
					<input type='radio' name='venue_selection' value='special_event'>Special Events
					</p>
					<p>
					<input type='radio' name='venue_selection' value='mingle'>Mingle
					</p>
					<p>
					<input type='radio' name='venue_selection' value='economical'>Economical
					</p>
					<p>
					<input type='radio' name='venue_selection' value='study'>Study
					</p>
					<p>
					<input type='radio' name='venue_selection' value='large_group' checked='checked'>Large Group
					</p>
					<p>
					<input type='radio' name='venue_selection' value='random'>Random
					</p>
					<p>
					<input type='radio' name='venue_selection' value='all'>All
					</p>
					<input type='submit' value='Recommend!'><br>
					</form>";
					break;
				case 'random':
					echo "<form method='POST' name='venueform' action='sorter.php'> 
					<p>
					<input type='radio' name='venue_selection' value='popular'>Popular
					</p>
					<p>
					<input type='radio' name='venue_selection' value='special_event'>Special Events
					</p>
					<p>
					<input type='radio' name='venue_selection' value='mingle'>Mingle
					</p>
					<p>
					<input type='radio' name='venue_selection' value='economical'>Economical
					</p>
					<p>
					<input type='radio' name='venue_selection' value='study'>Study
					</p>
					<p>
					<input type='radio' name='venue_selection' value='large_group'>Large Group
					</p>
					<p>
					<input type='radio' name='venue_selection' value='random' checked='checked'>Random
					</p>
					<p>
					<input type='radio' name='venue_selection' value='all'>All
					</p>
					<input type='submit' value='Recommend!'><br>
					</form>";
					break;
				case 'all':
					echo "<form method='POST' name='venueform' action='sorter.php'> 
					<p>
					<input type='radio' name='venue_selection' value='popular'>Popular
					</p>
					<p>
					<input type='radio' name='venue_selection' value='special_event'>Special Events
					</p>
					<p>
					<input type='radio' name='venue_selection' value='mingle'>Mingle
					</p>
					<p>
					<input type='radio' name='venue_selection' value='economical'>Economical
					</p>
					<p>
					<input type='radio' name='venue_selection' value='study'>Study
					</p>
					<p>
					<input type='radio' name='venue_selection' value='large_group'>Large Group
					</p>
					<p>
					<input type='radio' name='venue_selection' value='random'>Random
					</p>
					<p>
					<input type='radio' name='venue_selection' value='all' checked='checked'>All
					</p>
					<input type='submit' value='Recommend!'><br>
					</form>";
					break;
			}
		}
		else {
			$post_venue_selection = null;
			echo "<form method='POST' name='venueform' action='sorter.php'> 
					<p>
					<input type='radio' name='venue_selection' value='popular'>Popular
					</p>
					<p>
					<input type='radio' name='venue_selection' value='special_event'>Special Events
					</p>
					<p>
					<input type='radio' name='venue_selection' value='mingle'>Mingle
					</p>
					<p>
					<input type='radio' name='venue_selection' value='economical'>Economical
					</p>
					<p>
					<input type='radio' name='venue_selection' value='study'>Study
					</p>
					<p>
					<input type='radio' name='venue_selection' value='large_group'>Large Group
					</p>
					<p>
					<input type='radio' name='venue_selection' value='random'>Random
					</p>
					<input type='radio' name='venue_selection' value='all'>All
					</p>
					<input type='submit' value='Recommend!'><br>
					</form>";
		}
		//echo "Post_ID is: ". $post_venue_selection;

		//run through criteria for all entries
		foreach($json_arr as $data) {
			/*Criteria 1: Popular */
			if ( ($data->Rating > 7) && ($data->Likes > 50)) {
				//echo "popular: " . $data->Name . "<br/>";
				array_push($popular, $data->Venue_ID);
			}

			/*Criteria 2: Special Event */
			if ( ($data->Reservations == 'Y') && $data->Events_Count == 0) {
				//echo "special: " . $data->Name . "<br/>";
				array_push($special, $data->Venue_ID);
			}

			/*Criteria 3: Mingle*/
			if ( ($data->Alcohol == 'Y') || (strpos($data->Menus,'Happy Hour') !== false)
					|| (strpos($data->Venue_Type,'Bar') !== false) ) {
				//echo "mingle: " . $data->Name . "<br/>";
				array_push($mingle, $data->Venue_ID);
			}

			/*Criteria 4: Economical*/
			if ( $data->Price == '$') {
				//echo "cheap: ". $data->Name . "<br/>";
				array_push($economical, $data->Venue_ID);
			}

			/*Criteria 5: Study*/
			if ( ((strpos($data->Venue_Type,'Coffee') !== false) 
					|| (strpos($data->Venue_Type,'Cafe') !== false)) 
					&& ($data->Wifi == 'Y')) {
				//echo "study: " . $data->Name . "<br/>";
				array_push($study, $data->Venue_ID);
			}
			/*Criteria 6: Large Group*/
			if ( ($data->Reservations == 'Y') || (strpos($data->Venue_Type,'Restaurant') != false) ) {
				//echo "large group: $data->Name <br/>";
				array_push($large_group, $data->Venue_ID);
			}

			/*Criteria 7: Random*/
			foreach($numbers as $rand_num) {
				//echo $rand_num . "<br/>";
				if (substr((string)$data->Venue_ID,2,2) == $rand_num) {
					//echo "Match - Num: " . $rand_num . " " . $data->Venue_ID . "<br/>";
					array_push($random, $data->Venue_ID);
				}
			}

		}

		//determine which list to show based on selection
		switch ($post_venue_selection) {
			case 'popular':
				echo "Popular: <br/>";
				foreach($popular as $elem) {
					echo $elem . "<br/>";
				}
				break;
			case 'special_event':
				echo "Special Events: <br/>";
				foreach($special as $elem) {
					echo $elem . "<br/>";
				}
				break;
			case 'mingle':
				echo "Mingle: <br/>";
				foreach($mingle as $elem) {
					echo $elem . "<br/>";
				}
				break;
			case 'economical':
				echo "Economical: <br/>";
				foreach($economical as $elem) {
					echo $elem . "<br/>";
				}
				break;
			case 'study':
				echo "Study: <br/>";
				foreach($study as $elem) {
					echo $elem . "<br/>";
				}
				break;
			case 'large_group':
				echo "Large Group: <br/>";
				foreach($large_group as $elem) {
					echo $elem . "<br/>";
				}
				break;
			case 'random':
				echo "Random: <br/>";
				foreach($random as $elem) {
					echo $elem . "<br/>";
				}
				break;
			case 'all':
				//queries
				$sql = "SELECT Venue_ID, Name, Address, ZipCode from Venue";
				$results = mysqli_query($con,$sql);
				$num_rows = $results->num_rows;

				echo "<div>";
				if ($num_rows > 0) {
					echo "<table>";
					while($i = mysqli_fetch_array($results)) {
						echo "<tr>";
						$v_id = $i['Venue_ID'];
						$v_name = $i['Name'];
						$v_add = $i['Address'];
						$v_zip = $i['ZipCode'];
						echo "<td>" . $v_id . "</td>";
						echo "<td>" . $v_name . "</td>";
						echo "<td>" . $v_add . "</td>";
						echo "<td>" . $v_zip . "</td>";
						echo "</tr>";
					}
					echo "</table>";
				}
				else {
					echo "<p>No results found.</p>";
				}
				echo "</div>";
			default:
				echo "Please select an outing type!";
				break;
		}



		?>
		<br>
		<br>
	</div>
	</body>

	<footer>
	&copy; Team 9, CMPE 226, Fall 2014, SJSU<br>
	&copy; Foursquare Data obtained through the free API
   	</footer>


</html>