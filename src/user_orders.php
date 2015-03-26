<?php
session_start(); //start session
include_once("config.php"); //include config file
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>User Orders</title>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap-theme.min.css">
        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
        <link href="style.css" rel="stylesheet" type="text/css">
        <link href="user_orders.css" rel="stylesheet" type="text/css">
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
                        if ($_SESSION['flag'] == 1) {
                            $home = 'http://cs.uky.edu/~btga224/index2.php';
                        } elseif ($_SESSION['flag'] == 2) {
                            $home = 'http://cs.uky.edu/~btga224/staff.php';
                        } elseif ($_SESSION['flag'] == 3) {
                            $home = 'http://cs.uky.edu/~btga224/manager.php';
                        } else {
                            $home = 'http://cs.uky.edu/~btga224/index.php';
                        }

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
                            $user_id = $_SESSION['user_id'];
                            $name = $_SESSION['name'];
                            if ($_SESSION['flag'] == 1) {
                                echo '<li><a href=""> Welcome, ' . $name . '</a></li> ';
                                echo '<li><a href="http://cs.uky.edu/~btga224/logout.php">Logout</a></li>';
                                $home = 'http://cs.uky.edu/~btga224/index2.php';
                            } elseif ($_SESSION['flag'] == 2) {
                                echo '<li><a href=""> Welcome, ' . $name . '</a></li> ';
                                echo '<li><a href="http://cs.uky.edu/~btga224/logout.php">Logout</a></li>';
                                $home = 'http://cs.uky.edu/~btga224/staff.php';
                            } elseif ($_SESSION['flag'] == 3) {
                                echo '<li><a href=""> Welcome, ' . $name . '</a></li> ';
                                echo '<li><a href="http://cs.uky.edu/~btga224/logout.php">Logout</a></li>';
                                $home = 'http://cs.uky.edu/~btga224/manager.php';
                            } else {
                                echo ' <li><a href="http://cs.uky.edu/~btga224/login.html">Login</a></li>';
                                echo ' <li><a href="http://cs.uky.edu/~btga224/register.html">Register</a></li>';
                                $home = 'http://cs.uky.edu/~btga224/index.php';
                            }
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
			
			<div class="main-div" style="width: 40%;">
    		<div class="order-table">
					<legend>Order History</legend>
	        <script type="text/javascript">
	            function showSpoiler(obj)
	            {
	                var inner = obj.parentNode.getElementsByTagName("div")[0];
	                if (inner.style.display == "none")
	                    inner.style.display = "";
	                else
	                    inner.style.display = "none";
	            }
	        </script>
	        
	        <?php
	        
	        $results = $mysqli->query("SELECT * FROM orders WHERE u_id = '$user_id' ");
	        if ($results) {
	            echo ("<div style=' width: 100%; align-content:center;'><table style='margin: 0 auto;' border = '1'>
	                <tr>
	                   <td>Order No. </td>
	                   <td>Date </td>
	                   <td>Status </td>
	                   </tr>
	                  ");
	            while ($obj = $results->fetch_object()) {
	                echo ( " 
	                       <tr>
	                        <td> $obj->order_no </td>
	                        <td> $obj->order_date </td>
	                        <td> $obj->status </td>
	                       </tr>
	                      ");
	            }
	
	            echo "</table></div>";
	        }
	        ?>        
    			
    		</div>
    	</div>
</body>
</html>
