<?php
session_start();
include_once("config.php");

?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
		<!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap-theme.min.css">
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
		<link href="add_item.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="">
    <title>Add Items</title>
</head>
<body id="body-color">
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
    <div class="container register" style="width: 40%;">
        <div class="order-table">
            <legend>Add Item</legend>
            <table border="0">
                <tr>
                <form method="POST" action="add_item_update.php">
                <input type="text" name="name" placeholder="Product Name">
                <input type="text" name="code" placeholder="Product Code">
                <input type="text" name="price" placeholder="Price">
                <input type="text" name="qty" placeholder="Quantity">
                <textarea name="description" rows="10" cols="57" placeholder="Product Description"></textarea>
  							<hr>
                <tr>
                    <input class="btn-success" id="button" type="submit" name="submit" value="Add Item">
                </tr>
                </form>
            </table>
        </div>
    </div>
</body>
</html>
