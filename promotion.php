<html>
    <head>
        <title>Promotion</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap-theme.min.css">
        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
        <link href="style.css" rel="stylesheet" type="text/css">
        <link href="promotion.css" rel="stylesheet" type="text/css">
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
        
    <div class="button-div">
			   
      	<a href="http://cs.uky.edu/~btga224/manager_inv.php"><button class="back-btn">Go Back</button></a>
    	
    </div>
        
    <div class="main-div" style="width: 40%;">
			<div class="order-table">
			<legend>Promotion Options</legend>
			<?php
				session_start();
				include_once("config.php"); 
				
				if (isset($_GET["id"])) {
				    $item_id = $_GET["id"];
				    $return_url = "http://cs.uky.edu/~btga224/manager_inv.php";
				
				$sql = "select * from products where id =" .$item_id."";
				$results = $mysqli->query($sql);
				$obj = $results->fetch_object();
				
				$tot_price = number_format($obj->price - ($obj->price * ($obj->rate / 100.00)), 2); 
				echo '<form method="post" action="promotion_update.php">';
				echo 'Current Price: '. $tot_price.'<br>';
				echo '<input type="text" name="rate" value="" size="3" />';
				echo '<button class="add_to_cart" name = "type" value = "sale">Sale %</button><br>';
				echo'<a href="http://cs.uky.edu/~btga224/promotion_update.php?id='. $item_id . '">Remove sale</a>';
				echo '<input type="hidden" name="id" value="' . $item_id . '" />';
				echo '<input type="hidden" name="type" value="sale" />';
				echo '</form>';
				}
			?>
			</div>
		</div>
</body>
</html>
