<!DOCTYPE html>
<html>

   <head>
   <!-- 
   	Venue Recommender Login Page
   	Cmpe 226
   	Team 9
   	Xiaoli Jiang
   	Jennifer Wu
    -->

	<meta charset="UTF-8" />
	<title>FourU - Login</title>
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
		    <h1 class='text-center'>FourU Login</h1>
		</header>
	</div>

	<div class="container">
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<form class="form-horizontal" role="form" action="signup.php" method="post">
					<div class="form-group">
						<input type="email" class="form-control input-lg" id="email" 
							placeholder="Email">
					</div>
					<div class="form-group">
						<input type="password" class="form-control input-lg" id="inputPassword3"
							placeholder="Password">
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-default btn-success btn-lg">Sign in</button>
					</div>
				</form>
				<div>
					<p>Don't have an account? <a href="signuppage.php">Sign up</a>!</p>
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