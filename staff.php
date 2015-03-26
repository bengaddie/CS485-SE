<?php
session_start();
include_once("config.php");
?>

<html>
    <head>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap-theme.min.css">
        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
				<link href="staff.css" rel="stylesheet" type="text/css">
        <title> Staff Page </title>
    </head>
    <body>
        <div class="nav">
            <nav id="myNavbar" class="navbar navbar-inverse" role="navigation">
                <div class="container">
                    <!-- This Set's up the navbar that runs ontop of the screen -->
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-taget="#home-navbar-collapse-1">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <?php
                        $home = 'http://cs.uky.edu/~btga224/staff.php';


                        echo '<a class="navbar-brand" href="' . $home . '"> B & B Gaming </a>';
                        ?>
                    </div>
                    <!-- This is the actual dropdown menu, and where each item links.-->
                    <div class="collapse navbar-collapse" id="home-navbar-collapse-1">
                        <ul class="nav navbar-nav navbar-left">

                            <li><a href="http://cs.uky.edu/~btga224/view_cart.php">Cart</a></li>
                        </ul>
                        <ul class="nav navbar-nav navbar-right">
                            <?php
                            $name = $_SESSION['name'];
                            echo '<li><a href=""> Welcome, ' . $name . '</a></li> ';
                            echo '<li><a href="http://cs.uky.edu/~btga224/logout.php">Logout</a></li>';
                            ?>

                        </ul>
                    </div>
                </div>
            </nav>
        </div>

        <div class="boldener">
				<div style="text-align: center; color: #2B2B2B; font-size: 40px;">
						<div>Staff Options</div>
						<hr style="width: 30%; height: 1px; border-color: #2B2B2B;">
				</div>				
        <div class="container" style="width: 100%; text-align: center;">
            <a href="http://cs.uky.edu/~btga224/staff_inv.php">
	            <button class="box">View Inventory</button>
	          </a>
            <a href="http://cs.uky.edu/~btga224/staff_orders.php">
            	<button class="box">View Orders</button>
           	</a>
        </div>
      </div>
    </body>
</html>
