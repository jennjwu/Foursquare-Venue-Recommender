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
	<title>FourU Recommender</title>
	        <!-- Bootstrap Core CSS -->
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">

        <!-- Fonts -->
        <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <link href="css/animate.css" rel="stylesheet" />
        <!-- Squad theme CSS -->
        <link href="css/style.css" rel="stylesheet">
        <link href="color/default.css" rel="stylesheet">
   	</head>

   	<body>
      <?php session_start(); ?>
   	<nav class="navbar navbar-custom navbar-fixed-top top-nav" role="navigation">
           <div class="container">
               <div class="navbar-header">
                   <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
                       <i class="fa fa-bars"></i>
                   </button>
                   <a class="navbar-brand" href="index.html">
                       <h1>FourU</h1>
                   </a>
               </div>

               <!-- Collect the nav links, forms, and other content for toggling -->
               <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
                   <ul class="nav navbar-nav">
                       <li><a href="index.html">Home</a></li>
                       <li><a href="index.html#about">Category</a></li>
                       <li><a href="index.html#service">Hot Place</a></li>
                       <?php
                          if (isset($_SESSION['user_id']) && isset($_SESSION['name'])){
                            echo "<li class='dropdown'>
                                <a href='#' class='dropdown-toggle' data-toggle='dropdown'>";
                            echo $_SESSION['name'];
                          }
                          else {
                            echo "<li><a href='loginpage.php'>Login</a></li>
                            <li><a href='signuppage.php'>Sign Up</a></li>";
                        echo "<li class='dropdown'>
                                <a href='#' class='dropdown-toggle' data-toggle='dropdown'>Personalize";
                          }
                        ?>


                       <b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="#">User Home</a></li>
            <li><a href="#">Account Management</a></li>
            <li><a href="#">Logout</a></li>
          </ul>
        </li>
                   </ul>
               </div>
               <!-- /.navbar-collapse -->
           </div>
           <!-- /.container -->
        </nav>


	<section class="home-section1 text-center">
            <div class='section-heading'>
                <h1>FourU Recommender</h1>
                <?php
	                if (isset($_GET['category'])) {
	                	$category = $_GET['category'];
	                	$category = preg_replace('/_/', ' ', $category);
	                	echo "<h4>$category</h4>";
	            	}
            	?>
            </div>
        </section>

	<!--<div class='container'>
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
	</div>-->

	<div class='container' id='results'>	
		<div class='row'>
			<div class='col-sm-6'>
			<?php
				//call function to get queries based on criteria
				include 'queries.php';
				call_queries();
			?>
			</div>
			<div class='col-sm-6'>
				<div class='callout callout-warning'>
					<img alt='Placeholder for Google Map' height='500' width='500'>
				</div>
			</div>
		</div>
	</div>

		<footer class="footerstyle">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-lg-12">
                        <p>&copy; 2014 - FourU. All rights reserved.</p>
                    </div>
                </div>
            </div>
        </footer>

        <!-- Core JavaScript Files -->
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/jquery.easing.min.js"></script>
        <script src="js/jquery.scrollTo.js"></script>
        <script src="js/wow.min.js"></script>
        <!-- Custom Theme JavaScript -->
        <script src="js/custom.js"></script>

        <script type='text/javascript' src='sort.js'></script>
	</body>
</html>