<!DOCTYPE html>
<html>
   <head>
   <!-- 
   	Venue Recommender Search Page
   	Home html page for app
   	Team 9, CMPE 226, SJSU, Fall 2014
   	Xiaoli Jiang, Jennifer Wu
    -->
	<meta charset="UTF-8" />
	<title>Foursquare Venue Recommender</title>
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" />
	<link href="css/bootstrap-flat-extras.css" rel="stylesheet" />
	<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
	<script type='text/javascript' src='sort.js'></script>
   	</head>

   	<body>
	<div class='jumbotron'>
		<header>
		    <h1 class='text-center'>Venue Recommender</h1>
		</header>
	</div>
	<div class='container'>
		<p class='text-center'>Pick a Criteria!</p>
		<form id='venueform' class='form text-center' method='POST' action='sorter.php'>
			<div class='btn-group' data-toggle='buttons'>
				<label class='btn btn-primary'><input type='radio' name='venue_selection' value='popular'>Popular</label>
				<label class='btn btn-primary'><input type='radio' name='venue_selection' value='special_event'>Special Events</label>
				<label class='btn btn-primary'><input type='radio' name='venue_selection' value='mingle'>Mingle</label>
				<label class='btn btn-primary'><input type='radio' name='venue_selection' value='economical'>Economical</label>
				<label class='btn btn-primary'><input type='radio' name='venue_selection' value='study'>Study</label>
				<label class='btn btn-primary'><input type='radio' name='venue_selection' value='large_group'>Large Group</label>
				<label class='btn btn-primary'><input type='radio' name='venue_selection' value='random'>Random</label>
				<label class='btn btn-primary'><input type='radio' name='venue_selection' value='all'>All</label>
			</div>
			<br><br>
			<input type='submit' class='btn btn-success btn-large' value='Recommend!'>
		</form>
	</div>

	<div class='container' id='results'>	
	<?php
		//call function to get queries based on criteria
		include 'queries.php';
		call_queries();
	?>
	</div>

	</body>

	<footer class='col-md-12 text-center'>
		<hr>
		&copy; Team 9, CMPE 226, Fall 2014, SJSU<br>
		&copy; Foursquare Data obtained through the free API
		<br>
		<br>
   	</footer>
</html>