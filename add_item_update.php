<?php
session_start();
include_once("config.php");



if (isset($_POST['submit'])) {

    $name = $_POST["name"];
    $code = $_POST["code"];
    $price = $_POST["price"];
    $desc =  $_POST["description"];
    $qty = $_POST["qty"]; 
    $rate = 100.00;
    
    $sql = "INSERT INTO products(product_code, product_name, product_desc, price, quantity, rate) VALUES('$code', '$name', '$desc', $price, $qty, $rate)";
    if($mysqli->query($sql)){
    if($_SESSION["flag"] == "2"){
        $return_url = "http://cs.uky.edu/~btga224/staff_inv.php";   
    }
    if($_SESSION["flag"] == "3"){
        $return_url = "http://cs.uky.edu/~btga224/manager_inv.php";
    }
    header('Location:' . $return_url);
    }
    else{
         echo "Error: " . $sql . "<br>" . $mysqli->error;
    }
}
?>

