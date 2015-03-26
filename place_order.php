<html>
    <head>
        <title>Order Placed</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap-theme.min.css">
        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
        <link href="style.css" rel="stylesheet" type="text/css">
        <link href="place_order.css" rel="stylesheet" type="text/css">
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
        
<!--End of Header-->        
		
		<div class="main-div" style="width: 40%;">
			<div class="order-table">
			<legend>Order Placed</legend>
      <?php
				session_start();
				include_once("config.php");
				
				// make a new order
				$u_id = $_SESSION['user_id'];
				$date = date('Y-m-d');
				$new_order = $mysqli->query("INSERT INTO orders(u_id, order_date, status)  VALUES ('$u_id', '$date','Pending' )");
				if ($new_order) {
				
				    $last_id = $mysqli->insert_id;
				}
				// add items in cart to the order_items table
				
				
				$sql = "INSERT INTO orders_items (order_no, i_id, quantity, price) VALUES "; // ('$last_id','$product_id','$quant' )";
				foreach ($_SESSION["products"] as $cart_itm) {
				    $product_id = $cart_itm['id'];
				    $quant = $cart_itm['qty'];
				    $price = $cart_itm['price'];
				    $sql .= "('" . $last_id . "','" . $cart_itm['id'] . "','" . $cart_itm['qty'] . "','" . $price ."')";
				    if ($cart_itm != end($_SESSION["products"])) {
				        $sql .= ",";
				    }
				
				    // then add them to the orders_items table
				
				    echo 'Your order has been Succesfull Placed <br>';
				
				    
				       
				        // add quantity fix and empty cart
				        $sql2 = "SELECT * FROM products WHERE id = '$product_id' ";
				
				        $get_quant = $mysqli->query($sql2);
				        $obj = $get_quant->fetch_object();
				        
				        $new_quant = ((int) $obj->quantity - (int) $quant);
				        
				        $sql3 = "UPDATE products SET quantity = '$new_quant' WHERE id='$product_id'";
				        $mysqli->query($sql3);
				        
				        $_SESSION["products"] = array();
				    
				}
				$mysqli->query($sql) 
				
				// get original quantity
				
				
				;
				//$set_quant = $mysqli->query("UPDATE products SET quantity = '$new_quant' WHERE product_code='$product_id'");
				//$results = $mysqli->query("UPDATE products SET quantity = '$product_qty' WHERE product_code='$product_code'");
				// 
				// echo 'Products sucessfully updated '; 
			?>
			
			  <br><br>
			  
	      	<a href="http://cs.uky.edu/~btga224/index2.php"><button class="home-btn">Home page</button></a>
	      	<a href="http://cs.uky.edu/~btga224/cart.php"><button class="shop-btn">Continue shopping</button></a>
	    	
			</div>
    </div>
    <br>
    </body>
