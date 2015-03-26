<?php
session_start();
include_once("config.php");
?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Shopping Cart</title>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap-theme.min.css">
        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
        <link href="style.css" rel="stylesheet" type="text/css">
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
        <div id="products-wrapper">
            <h1>Products</h1>
            <div class="products">
                            <?php
                            //current URL of the Page. cart_update.php redirects back to this URL
                            $current_url = base64_encode($url = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);

                            $results = $mysqli->query("SELECT * FROM products ORDER BY id ASC");
                            if ($results) {

                                //fetch results set as object and output HTML
                                while ($obj = $results->fetch_object()) {
                                     $tot_price = number_format($obj->price - ($obj->price * ($obj->rate / 100.00)), 2); 
                                    echo '<div class="product block">';
                                    echo '<form method="post" action="cart_update.php">';
                                    echo '<div class="product-thumb"><img src="' . $obj->product_img_name . '"></div>';
                                    echo '<div class="product-content"><h3>' . $obj->product_name . '</h3>';
                                    echo '<div class="product-desc">' . $obj->product_desc . '</div>';
                                    echo '<div class="product-info">';
                                    echo 'Price ' . $currency . $tot_price . ' | ';
                                    echo 'Qty <input type="text" name="product_qty" value="1" size="3" />';
                                    echo '<button class="add_to_cart">Add To Cart</button>';
                                    echo '</div></div>';
                                    echo '<input type="hidden" name="product_code" value="' . $obj->product_code . '" />';
                                    echo '<input type="hidden" name="type" value="add" />';
                                    echo '<input type="hidden" name="return_url" value="' . $current_url . '" />';
                                    echo '</form>';
                                    echo '</div>';
                                }
                            }
                            ?>
            </div>

            <div class="shopping-cart">
                <h2>Your Shopping Cart</h2>
                <?php
                if (isset($_SESSION["products"]) && count($_SESSION["products"]) != 0) {
                    $total = 0;
                    echo '<ol>';
                    foreach ($_SESSION["products"] as $cart_itm) {
                        echo '<li class="cart-itm">';
                        echo '<span class="remove-itm"><a href="cart_update.php?removep=' . $cart_itm["code"] . '&return_url=' . $current_url . '">&times;</a></span>';
                        echo '<h3>' . $cart_itm["name"] . '</h3>';
                        echo '<div class="p-code">P code : ' . $cart_itm["code"] . '</div>';
                        echo '<div class="p-qty">Qty : ' . $cart_itm["qty"] . '</div>';
                        echo '<div class="p-price">Price :' . $currency . $cart_itm["price"] . '</div>';
                        echo '</li>';
                        $subtotal = ($cart_itm["price"] * $cart_itm["qty"]);
                        $total = ($total + $subtotal);
                    }
                    echo '</ol>';
                    echo '<span class="check-out-txt"><strong>Total : ' . $currency . $total . '</strong> <a href="view_cart.php">Check-out!</a></span>';
                    echo '<span class="empty-cart"><a href="cart_update.php?emptycart=1&return_url=' . $current_url . '">Empty Cart</a></span>';
                } else {
                    echo 'Your Cart is empty';
                }
                ?>
            </div>

        </div>

    </body>
</html>


