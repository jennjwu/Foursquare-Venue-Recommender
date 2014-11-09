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
        <nav class="navbar navbar-custom navbar-fixed-top top-nav" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
                        <i class="fa fa-bars"></i>
                    </button>
                    <a class="navbar-brand" href="index.php">
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
                          <a href="#" class="dropdown-toggle active" data-toggle="dropdown">Personalize
                            <b class="caret"></b></a>
                          <ul class="dropdown-menu">
                            <li><a href="loginpage.php">Login</a></li>
                            <li><a href="signuppage.php">Sign Up</a></li>
                          </ul>
                      </li>
                   </ul>
               </div>
               <!-- /.navbar-collapse -->
           </div>
           <!-- /.container -->
        </nav>

        <div class="wrapper">
            <!-- Section: sign in -->
            <br/>
            <section class="home-section1 text-center">
                <div class='section-heading'>
                    <h1>FourU Login</h1>
                </div>
            </section>

        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <div id="validate">
                      <?php
                          include 'php/login.php';
                          if ($error) {
                              echo "<h5 class='text-danger text-center'>Your email and password combination do not match. Please try again.</h5>";
                          }
                          else if ($notfound) {
                              echo "<h5 class='text-danger text-center'>Your email address cannot be found in FourU. <br>Have you 
                                <a href='signuppage.php'>signed up</a>?</h5>";   
                          }
                      ?>
                  </div>
                    <form class="form-horizontal" role="form" action="loginpage.php" method="post">
                        <?php
                            if ($notfound) {
                                echo "<div class='form-group has-error'>
                                        <input type='email' class='form-control input-lg' name='email'
                                            placeholder='Email' required='required'>
                                    </div>";        
                            }
                            else if ($error) {
                                echo "<div class='form-group'>
                                        <input type='email' class='form-control input-lg' name='email' value='$user_email'
                                            placeholder='Email' required='required'>
                                    </div>";
                            }
                            else {
                                echo "<div class='form-group'>
                                        <input type='email' class='form-control input-lg' name='email'
                                            placeholder='Email' required='required'>
                                    </div>";   
                            }
                        ?>
                        <?php 
                            if($error || $notfound) {
                                echo "<div class='form-group has-error'>
                                      <input type='password' class='form-control input-lg' name='password'
                                          placeholder='Password' required='required'>
                                      </div>";
                            }
                            else {
                              echo "<div class='form-group'>
                                      <input type='password' class='form-control input-lg' name='password'
                                          placeholder='Password' required='required'>
                                      </div>";
                            }
                        ?>
                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-default btn-success btn-lg">Login</button>
                        </div>
                    </form>
                    <div>
                        <p class='text-center'>Don't have an account?<br> 
                            <a href="signuppage.php"> Sign up</a>!</p>
                    </div>
                </div>
            </div>
        </div>
      </div>

        <footer class="footerstyle">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-lg-12">
                        <p>&copy;2014 - FourU. All rights reserved.</p>
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