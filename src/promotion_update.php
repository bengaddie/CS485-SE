<?php
session_start();
include_once("config.php"); 

if(isset($_GET["id"])){
    $rate = "0.00";
    $id = $_GET["id"];
    echo 'Test 1';
    $return_url = "http://cs.uky.edu/~btga224/promotion.php?id=".$id."";
    $results = $mysqli->query("UPDATE products SET rate = '$rate' WHERE id='$id'");
    header('Location:' . $return_url);
}

if(isset($_POST["rate"])){
    echo 'Test 1';
    $item_id = $_POST["id"];
    $rate2 = $_POST["rate"]; //product quantity
    $return_url = "http://cs.uky.edu/~btga224/promotion.php?id=".$item_id."";
    $results = $mysqli->query("UPDATE products SET rate = '$rate2' WHERE id='$item_id'");
    header('Location:' . $return_url);
}
?>
