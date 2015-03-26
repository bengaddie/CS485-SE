<?php

        $username = "btga224";
        $password = "u0705355";
        $dbname = "test";
        $server = "mastelottoplan.backups.uky.edu";//"mysql.cs.uky.edu";
        // Connecting to the SQL server at cs.uky.edu.
        $conn = mysqli_connect( $server, $username, $password, $dbname);
        if (!$conn) {
                 die("Connection failed: " . mysqli_connect_error);
        }
        
        function newUser($conn)
        {
            
            $first = $_POST['fname'];
            $last = $_POST['lname'];
            $street = $_POST['street'];
            $city = $_POST['city'];
            $state = $_POST['state'];
            $email = $_POST['email'];
            $pass = $_POST['password'];
            $flag = 1;
            $query1 = "INSERT INTO user (f_name, l_name, street, city, state, email, password, flag) VALUES ('$first', '$last', '$street', '$city', '$state', '$email', '$pass', '$flag')";
            $data = mysqli_query($conn, $query1) or die(mysqli_error($conn));
            if($data)
            {
                $return_url = "http://cs.uky.edu/~btga224/index2.php";
                echo 'Your registration is completed. ';
                header('Location:'.$return_url);
            }
        }
        
        function signup($conn)
        {
            
            if(!empty($_POST['email'])); // Check to see if the email form is empty
            {
                $checkUser = mysqli_query($conn, "SELECT * FROM user WHERE email = '$_POST[email]' AND password = '$_POST[password]'") or die(mysqli_error($conn)); 
                if(!$row = mysqli_fetch_array($checkUser) or die(mysqli_error($conn)))
                {
                    newUser($conn);
                }
                else
                {
                    echo "Sorry you are already a registered user. ";
                }
            }    
        }
        
        if(isset($_POST['submit']))
        {
            
            signup($conn);
        }
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Registration Complete</title>
    </head>
    <body>
    </body>
</html>
