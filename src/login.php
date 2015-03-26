<?php

//session_start();
include_once("config.php");

function login($conn) {
    session_start();
    if (!empty($_POST['email'])) {
        $getInfo = mysqli_query($conn, "SELECT * FROM user WHERE email = '$_POST[email]' AND password = '$_POST[password]'") or die(mysqli_error($conn));
        $row = mysqli_fetch_array($getInfo) or die(mysqli_error($conn));
        if (!empty($row['email']) AND !empty($row['password'])) {
            $_SESSION['email'] = $row['password'];
            $_SESSION['name'] = $row['f_name'];
            $_SESSION['user_id'] = $row['u_id'];
            $_SESSION['flag'] = $row['flag'];

            if ($row['flag'] == 1) {
                header("Location: http://cs.uky.edu/~btga224/index2.php");
                die;
            } elseif ($row['flag'] == 2) {
                header("Location: http://cs.uky.edu/~btga224/staff.php");
                die;
            } else {
                header("Location: http://cs.uky.edu/~btga224/manager.php");
                die;
            }
        } else {
            echo "SORRY... YOU ENTERD WRONG ID AND PASSWORD... PLEASE RETRY...";
        }
    }
}

if (isset($_POST['submit'])) {
    login($mysqli);
}
?>
