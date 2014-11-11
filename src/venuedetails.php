<!DOCTYPE html>
<html>
<head>
    <!--
        Venue Recommender Venue Detail Page
        Home html page for app
        Team 9, CMPE 226, SJSU, Fall 2014
        Xiaoli Jiang, Jennifer Wu
     -->
    <meta charset="UTF-8" />
    <title>Venue Details</title>
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

                    <li class="dropdown">
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

    <?php
    if (isset($_GET['FS_ID'])) {
        $FS_ID = $_GET['FS_ID'];
        echo "<h4 id='FS_ID'>$FS_ID</h4>";
    }
    ?>

    <!-- venue title info --->
    <section class="home-section1 text-center">
        <div class='section-heading'>
            <div class="row">
                <h1 class="venuemeta">
                    <span id="venue_name" class="pull-left"></span>
                    <span id="rating">
                        Rating: <span id="venue_rating"></span>
                    </span>
                    <span id="price">
                        Price: <span id="venue_price"></span>
                    </span>

                </h1>
                <div class="alien_right col-sm-10">
                    <button id="save_venue" class="btn btn-lg btn-warning" data-toggle="modal" data-backdrop="static" data-target="#saveModal">Save FourU</button>
                </div>

            </div>


            <div id="category" >
                <div class="col-sm-10" id="venue_category">
                </div>
            </div>


        </div>
    </section>

    <div class="container">
        <br/>
        <div class="row">

            <!-- venue meta info --->
            <div id="venue_meta" class="col-sm-7 bg-gray venuemeta ">
                <div >
                    <div class="row">
                        <div class="col-sm-2">
                            <strong>Address: </strong>
                        </div>
                        <div class="col-sm-10" id="venue_address">
                        </div>
                    </div>
                </div>

                <div id="contact" >
                    <div class="row">
                        <div class="col-sm-2">
                            <strong>Contact: </strong>
                        </div>
                        <div class="col-sm-10" id="venue_contact">
                        </div>
                    </div>
                </div>

                <div id="url">
                    <div class="row">
                        <div class="col-sm-2">
                            <strong>URL: </strong>
                        </div>
                        <div class="col-sm-10" id="venue_url">
                        </div>
                    </div>
                </div>

                <br/>

                <div id="isopen" >
                    <div class="row">
                        <div class="col-sm-2">
                            <strong>IsOpen: </strong>
                        </div>
                        <div class="col-sm-8" id="venue_isopen">
                        </div>
                    </div>
                </div>

                <div id="likes" >
                    <div class="row">
                        <div class="col-sm-2">
                            <strong>Likes: </strong>
                        </div>
                        <div class="col-sm-8" id="venue_likes">
                        </div>
                    </div>
                </div>

                <div id="checkins" >
                    <div class="row">
                        <div class="col-sm-2">
                            <strong>CheckIns: </strong>
                        </div>
                        <div class="col-sm-8" id="venue_checkins">
                        </div>
                    </div>
                </div>

            </div>

            <!-- venue map  --->
            <div class="col-sm-4">
                <div id="venue_map" >
                </div>
            </div>


        </div>


    </div>


    <div class="container">
        <br/>
        <br/>
        <h4>Tips From Others</h4>
        <div id="venue_tips" class="col-sm-11">
        </div>
    </div>

</div>

<footer>
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-lg-12">
                <p>&copy; 2014 - FourU. All rights reserved.</p>
            </div>
        </div>
    </div>
</footer>-->

<!-- save modal -->
<div class="modal fade" id="saveModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Save Venue For U</h4>
            </div>
            <div class="modal-body">

                <!-- Save model form
                ====================================================================== -->
                <form class="form-horizontal" action="php/add.php" method="post">
                    <div class='form-group text-center'>

                        <?php echo "<input type='hidden' name='FS_ID' value='"
                            . $FS_ID ."'>";?>

                        <label class="tiptext" for="visit_date">Pick A Visit Date: </label>
                        <input id="date_visit" type="date" name="date_visit" placeholder='yyyy-mm-dd' required>

                    </div>


                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-default btn-success btn-lg">GO FourU</button>
                    </div>

                </form>

            </div><!-- /. modal-body -->
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- Core JavaScript Files -->
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.easing.min.js"></script>
<script src="js/jquery.scrollTo.js"></script>
<script src="js/wow.min.js"></script>
<!-- Custom Theme JavaScript -->
<script src="js/custom.js"></script>
<!--FourSquare-->
<script src="js/fourSquareAPI.js"></script>

<!--Google Map-->
<script src="js/gmaps.js"></script>

</body>
</html>