<?php

session_start(); //start session
include_once("config.php"); //include config file
//add to inventory
if (isset($_POST["type"]) && $_POST["type"] == 'add') {
    $product_id = filter_var($_POST["product_code"], FILTER_SANITIZE_STRING); //product id
    $product_qty = filter_var($_POST["product_qty"], FILTER_SANITIZE_NUMBER_INT); //product quantity
    $return_url = base64_decode($_POST["return_url"]); //return url
    //MySqli query - get details of item from db using product code
    $results = $mysqli->query("UPDATE products SET quantity = '$product_qty' WHERE id='$product_id'");



    //redirect back to original page
    header('Location:' . $return_url);
}

//if (isset($_POST["type"]) && $_POST["type"] == 'pro'){
   // echo 'Test 1';
   // $return_url = base64_decode($_POST["return_url"]); //return url
    //$product_id = filter_var($_POST["product_code"], FILTER_SANITIZE_STRING); //product id
   // $rate = $_POST["rate"];
    //$mysqli->query("UPDATE products SET rate = '$rate' WHERE id='$product_id'");   
   // header('Location:' . $return_url);
//}

 
?>
