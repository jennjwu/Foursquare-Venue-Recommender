<!DOCTYPE html>
<html>
   <head>
   <!-- 
   	Venue Recommender User Acct Mgmt Page
   	Home html page for app
   	Team 9, CMPE 226, SJSU, Fall 2014
   	Xiaoli Jiang, Jennifer Wu
    -->
	<meta charset="UTF-8" />
	<title>Manage U</title>
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
                      
                      <li class="dropdown">
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

                      <li class="dropdown active">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <?php
                          if (isset($_SESSION['user_id']) && isset($_SESSION['name'])){
                            echo $_SESSION['name'];
                            echo "<b class='caret'></b></a>
                                <ul class='dropdown-menu'>
                                  <li><a href='userhome.php'>User Home</a></li>
                                  <li><a href='account.php'>Account Management</a></li>
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
                <h1>Manage Your Info</h1>
            </div>
        </section>

	 <div class="container">
          <div class="row">
              <div class="col-md-6 col-md-offset-3">
                  <?php
                    include "php/userqueries.php";
                    get_user();
                    //include "php/signup.php";
                    /*if ($pw_mismatch) {
                        echo "<h5 class='text-danger text-center'>Your passwords do not match.<br>
                        Please try again.</h5>";
                    }
                    if ($existing) {
                        echo "<h5 class='text-danger text-center'>Your email already exists in FourU.<br>
                        Do you want to <a href='loginpage.php'>login</a>?</h5>";
                    }*/
                  ?>
                  <form class='form-horizontal' role='form' action='account.php' method='post'>
                  <?php
                    echo "<div class='form-group'>
                            <input type='text' class='form-control input-lg' name='user_name' 
                                placeholder='New Name' id='name'>
                          </div>
                          <div class='form-group'>
                              <input type='number' class='form-control input-lg' name='zipcode' 
                                placeholder='New Zipcode' id='zipcode'>
                          </div>
                          <div class='form-group'>
                              <input type='email' class='form-control input-lg' name='email'
                                  placeholder='New Email' id='email'>
                          </div>
                          <div class='form-group text-center'>
                              <button type='submit' class='btn btn-default btn-success btn-lg'>Update</button>
                          </div>
                      </form>";
                  ?>
              </div>
          </div>
      </div>
    </div><!--end wrapper-->

		<footer>
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
	</body>
</html>