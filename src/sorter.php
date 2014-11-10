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


       <!-- google map -->
       <script type="text/javascript"
               src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDT32xVCkqxlZQz5DQly-1-6j7RlsouvM8">
       </script>

   	</head>

   	<body>
      <?php session_start(); ?>
      <div class="wrapper">
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
                      <li><a href="index.php">Home</a></li>
                      <li><a href="index.php#about">Category</a></li>
                      <li><a href="index.php#service">Hot Place</a></li>
                       <li class="dropdown active">
                           <a href="#" class="dropdown-toggle" data-toggle="dropdown">Recommender<b class="caret"></b></a>
                           <ul class="dropdown-menu">
                               <li><a href="sorter.php?category=popular">Popular</a></li>
                               <li><a href="sorter.php?category=special_event">Special Event</a></li>
                               <li><a href="sorter.php?category=large_group">Large Group</a></li>
                               <li><a href="sorter.php?category=study">Study</a></li>
                               <li><a href="sorter.php?category=mingle">Mingle</a></li>
                               <li><a href="sorter.php?category=economical">Economical</a></li>
                               <li><a href="sorter.php?category=random">Random</a></li>
                               <li><a href="sorter.php?category=all">All</a></li>
                           </ul>
                       </li>


                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <?php
                          if (isset($_SESSION['user_id']) && isset($_SESSION['name'])){
                            echo $_SESSION['name'];
                            echo "<b class='caret'></b></a>
                                <ul class='dropdown-menu'>
                                  <li><a href='userhome.php'>User Home</a></li>
                                  <li><a href='#'>Account Management</a></li>
                                  <li><a href='php/logout.php'>Logout</a></li>
                                </ul>";
                          }
                          else {
                            echo "Personalize
                                  <b class='caret'></b></a>
                                      <ul class='dropdown-menu'>";
                            echo "<li><a href='loginpage.php'>Login</a></li>
                                  <li><a href='signuppage.php'>Sign Up</a></li>
                                  </ul>";
                          }
                        ?>
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
                    echo "<h4 class='category'>$category</h4>";
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
                <div class='col-sm-6' id='venue-results'>
                    <?php
                    //call function to get queries based on criteria
                    include 'php/queries.php';
                    call_queries();
                    ?>
                </div>
                <div class='col-sm-6'>
                    <div class>
                        <div id="map"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>


      <footer>
          <div class="container">
              <div class="row">
                  <div class="col-md-12 col-lg-12">
                      <p>Team 9, CMPE 226, Fall 2014, SJSU</p>
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


      <!--FourSquare-->
      <script src="js/mapAPI.js"></script>

      <!--Google Map-->
      <script src="js/gmaps.js"></script>

	</body>
</html>