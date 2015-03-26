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
				<script type="text/javascript">
	        var image1 = new Image()
	        image1.src = "Duck.jpg"
	
	        var image2 = new Image()
	        image2.src = "mario.jpg"
	        
					var image3 = new Image()
	        image3.src = "monopoly.jpg"
	
	        var image4 = new Image()
	        image4.src = "zelda.jpg"
	        
	        var image5 = new Image()
	        image5.src = "clue.jpg"
	
	        var image6 = new Image()
	        image6.src = "NTurtle.jpg"        
    		</script>
   		  <link href="index.css" rel="stylesheet" type="text/css">
        <title> Toy and Game Store </title>
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
                        $home = 'http://cs.uky.edu/~btga224/index2.php';


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


        <div class="container main-div" style="width: 30%;">
		    	<span id="browse-div">
		  	  	<a href="http://cs.uky.edu/~btga224/cart.php">Browse Items
			  	  	<img src="fun.jpg" name="slide" >
					    <script type="text/javascript">
					        var step = 1
					        function slideit() {
					            document.images["slide"].src = eval("image" + step + ".src")
					            if (step < 6)
					                step++
					
					            else
					                step = 1
					            setTimeout("slideit()", 3000)
					        }
					        slideit()
					    </script>
					  </a>
					</span>
					
    		</div>
    		<span class="col-md-4 col-xs-offset-6" style="margin-top: 10px;">
					<a href="http://cs.uky.edu/~btga224/user_orders.php"><button>View Orders </button></a>
				</span>
    		
    </body>
</html>
