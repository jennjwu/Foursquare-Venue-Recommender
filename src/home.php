<!DOCTYPE html>
<html>

   <head>
   <!-- 
   	Venue Recommender Home Page
   	Cmpe 226
   	Team 9
   	Xiaoli Jiang
   	Jennifer Wu
    -->

	<meta charset="UTF-8" />
	<title>FourU - Home</title>
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" />
	<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
	<script type='text/javascript' src='sort.js'></script>
   </head>

   <body>
   <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
   		<div class="container-fluid">
   			<ul class="nav navbar-nav">
   				<li><a href="home.php">Home</a></li>
   				<li><a href="sorter.php">Recommender</a></li>
   			</ul>
   			<div class="nav navbar-right">
   				<a href="loginpage.php">
   					<button type="button" class="btn btn-default navbar-btn">Login</button>
   				</a>
   				<a href="signuppage.php">
   					<button type="button" class="btn btn-default navbar-btn">Sign Up</button>
   				</a>
   			</div>
   		</div>
   	</nav>

	<div class='jumbotron'>
		<header>
		    <h1 class='text-center'>Where to go today?</h1>
		</header>
	</div>

	<div class="container">
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<div class="bg-info">
					<p>Placeholder for some nice pictures here?<br>
						some text<br>
						some text<br>
						other text<br><br><br><br><br><br><br>
					</p>
				</div>
			</div>
		</div>
	</div>


	</body>

	<footer class='col-md-12 text-center'>
		<hr>
		&copy; Team 9, CMPE 226, Fall 2014, SJSU<br>
		&copy; Foursquare Data obtained through the free API
   	</footer>
</html>