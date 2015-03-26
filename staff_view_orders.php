<?php

session_start();
include_once("config.php");

if (isset($_GET["id"])) {
    $order_id = $_GET["id"];
    $return_url = "http://cs.uky.edu/~btga224/staff_orders.php";
    $sql = "UPDATE orders SET status='Shipped' WHERE order_no='$order_id'";
    echo "TEST 1 ".$order_id."";
    if ($mysqli->query($sql) === TRUE) {
        echo 'TEST 2';
        header('Location:' . $return_url);
    } else {
        echo "Error: " . $sql . "<br>" . $mysqli->error;
    }
}

?>



