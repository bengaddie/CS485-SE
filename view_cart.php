<?php
session_start();
include_once("config.php");
?>
<!DOCTYPE html>
<html>
    <head>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap-theme.min.css">
        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>View shopping cart</title>
        <link href="style.css" rel="stylesheet" type="text/css"></head>
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
        <div id="products-wrapper">
            <h1>View Cart</h1>
            <div class="view-cart">
<?php
$current_url = base64_encode($url = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
if (isset($_SESSION["products"])) {
    $total = 0;
    echo '<form method="post" action="place_order.php">';
    echo '<ul>';
    $cart_items = 0;
    foreach ($_SESSION["products"] as $cart_itm) {
        $product_code = $cart_itm["code"];
        $results = $mysqli->query("SELECT product_name,product_desc, price FROM products WHERE product_code='$product_code' LIMIT 1");
        $obj = $results->fetch_object();
        $tot_price = number_format($obj->price - ($obj->price * ($obj->rate / 100.00)), 2); 
        echo '<li class="cart-itm">';
        echo '<span class="remove-itm"><a href="cart_update.php?removep=' . $cart_itm["code"] . '&return_url=' . $current_url . '">&times;</a></span>';
        echo '<div class="p-price">' . $currency . $tot_price . '</div>';
        echo '<div class="product-info">';
        echo '<h3>' . $obj->product_name . ' ( Code : ' . $product_code . ')</h3> ';
        echo '<div class="p-qty">Qty : ' . $cart_itm["qty"] . '</div>';
        echo '<div>' . $obj->product_desc . '</div>';
        echo '</div>';
        echo '</li>';
        $subtotal = ($cart_itm["price"] * $cart_itm["qty"]);
        $total = ($total + $subtotal);

        echo '<input type="hidden" name="item_name[' . $cart_items . ']" value="' . $obj->product_name . '" />';
        echo '<input type="hidden" name="item_code[' . $cart_items . ']" value="' . $product_code . '" />';
        echo '<input type="hidden" name="item_desc[' . $cart_items . ']" value="' . $obj->product_desc . '" />';
        echo '<input type="hidden" name="item_qty[' . $cart_items . ']" value="' . $cart_itm["qty"] . '" />';
        $cart_items++;
    }
    echo '</ul>';
    echo '<span class="check-out-txt">';
    echo '<strong>Total : ' . $currency . $total . '</strong>  ';
    if($_SESSION['flag'] > 0){
        echo ' <br> <a href="http://cs.uky.edu/~btga224/place_order.php"> Check Out </a>';
    }
    else{
        echo '<br> <a href="http://cs.uky.edu/~btga224/register.html"> Register to Check Out </a>';
    }
    
    echo '</span>';
    echo '</form>';
} else {
    echo 'Your Cart is empty';
}
?>
            </div>
        </div>

    </body>
</html>

