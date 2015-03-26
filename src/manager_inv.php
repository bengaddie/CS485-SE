<?php
session_start();
include_once("config.php"); 
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap-theme.min.css">
        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
        <link href="style.css" rel="stylesheet" type="text/css">
        <title> Inventory </title>
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
        <div id="products-wrapper">
            <h1>Products</h1>
            <div class="products"> 
                <?php
                 echo '<a href="http://cs.uky.edu/~btga224/add_item.php"><h3>Add Item</h3><a>';
                $current_url = base64_encode($url = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
                $results = $mysqli->query("SELECT * FROM products ORDER BY id ASC");
                if ($results) {

                    //fetch results set as object and output HTML
                    while ($obj = $results->fetch_object()) {
                        $results = $mysqli->query("SELECT * FROM products ORDER BY id ASC");
                        if ($results) {

                            //fetch results set as object and output HTML
                            while ($obj = $results->fetch_object()) {

                                echo '<div class="product">';
                                echo '<form method="post" action="staff_update.php">';
                                echo '<div class="product-thumb"><img src="' . $obj->product_img_name . '"></div>';
                                echo '<div class="product-content"><h3>' . $obj->product_name . '</h3>';
                                $tot_price = number_format($obj->price - ($obj->price * ($obj->rate / 100.00)), 2); 
                                echo '<div class="product-desc">Current quantity: ' . $obj->quantity . '<br> Price: '. $tot_price  .'</div>';
                                echo '<div class="product-info">';
                               // echo '<input type="text" name="rate" value=" " size="3" />';
                               // echo '<button class="add_to_cart" name ="type" value = "pro">Set Promotion Rate</button>';
                                echo '<a href="http://cs.uky.edu/~btga224/promotion.php?id='. $obj->id .'">Promotion</a>';
                                echo '<br>';
                                echo '<input type="text" name="product_qty" value="1" size="3" />';
                                echo '<button class="add_to_cart" name = "type" value = "add">Set Inventory Qty.</button>';
                                echo '</div></div>';
                                echo '<input type="hidden" name="product_code" value="' . $obj->id . '" />';
                                echo '<input type="hidden" name="type" value="add" />';
                                echo '<input type="hidden" name="return_url" value="' . $current_url . '" />';
                                echo '</form>';
                                echo '</div>';
                            }
                        }
                    }
                }
                ?>
            </div>
        </div>
    </body>
</html>
