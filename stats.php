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
		    <link href="stats.css" rel="stylesheet" type="text/css">
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
                        $home = 'http://cs.uky.edu/~btga224/manager.php';


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
        <div class="go-back">
			    <button class="back-btn" onclick="goBack()"> &#8617; Back to Options </button>
					<script>
					function goBack() {
					    window.history.back()
					}
					</script>
				</div>
        <div>
        	<div class="main-div" style="width: 30%;">
		        <h1>Items sold</h1> 
		        <hr>
		        <?php
		        $sql = "SELECT i_id, SUM(quantity) AS quantity, price FROM orders_items GROUP BY i_id";
		        $results = $mysqli->query($sql);
		        if($results){
		        $tot_rev = 0;
		        $tot_qty = 0;
		        while($obj = $results->fetch_object()){
		            $rev = $obj->quantity * $obj->price;
		            $tot_rev = $tot_rev + $rev;
		            $tot_qty += $obj->quantity;
		            echo 'ID: '.$obj->i_id. ', Qty: '.$obj->quantity.'<br> ';
		        }
		        echo 'Total Items sold: '. $tot_qty .'<br>';
		        
		        echo '<br> <h1>Revenue</h1> <hr>';
		        echo 'Total Revenue: '. $tot_rev .'<br>';
		        }
		        else{
		              echo "Error: " . $sql . "<br>" . $mysqli->error;
		        } 
		        ?>
		      </div>
	      </div>
        </body>
</html>
