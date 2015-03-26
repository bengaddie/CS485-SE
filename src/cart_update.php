<?php

session_start(); //start session
include_once("config.php"); //include config file
//empty cart by distroying current session
if (isset($_GET["emptycart"]) && $_GET["emptycart"] == 1) {
    $return_url = base64_decode($_GET["return_url"]); //return url
    
    $_SESSION["products"] = array();
    //session_destroy();
    header('Location:' . $return_url);
}

//add item in shopping cart
if (isset($_POST["type"]) && $_POST["type"] == 'add') {
    $product_code = filter_var($_POST["product_code"], FILTER_SANITIZE_STRING); //product code
    $product_qty = filter_var($_POST["product_qty"], FILTER_SANITIZE_NUMBER_INT); //product quantity
    $return_url = base64_decode($_POST["return_url"]); //return url
    //MySqli query - get details of item from db using product code
    $results = $mysqli->query("SELECT product_name,price,quantity,id FROM products WHERE product_code='$product_code' LIMIT 1");
    $obj = $results->fetch_object();

    //limit quantity for single product will handle this in orders
    if ($product_qty > $obj->quantity) {
        echo "<script>alert('You cannot buy more than there are available!'); location.href='cart.php';</script>";
        exit();
    }

    if ($results) { //we have the product info 
        //prepare array for the session variable
        $new_product = array(array('name' => $obj->product_name, 'code' => $product_code, 'qty' => $product_qty, 'price' => $obj->price, 'id' => $obj->id));

        if (isset($_SESSION["products"])) { //if we have the session
            $found = false; //set found item to false

            foreach ($_SESSION["products"] as $cart_itm) { //loop through session array
                if ($cart_itm["code"] == $product_code) { //the item exist in array
                    $product[] = array('name' => $cart_itm["name"], 'code' => $cart_itm["code"], 'qty' => $product_qty, 'price' => $cart_itm["price"], 'id' => $cart_itm["id"]);
                    $found = true;
                } else {
                    //item doesn't exist in the list, just retrive old info and prepare array for session var
                    $product[] = array('name' => $cart_itm["name"], 'code' => $cart_itm["code"], 'qty' => $cart_itm["qty"], 'price' => $cart_itm["price"], 'id' => $cart_itm["id"]);
                }
            }

            if ($found == false) { //we didn't find item in array
                //add new user item in array
                $_SESSION["products"] = array_merge($product, $new_product);
            } else {
                //found user item in array list, and increased the quantity
                $_SESSION["products"] = $product;
            }
        } else {
            //create a new session var if does not exist
            $_SESSION["products"] = $new_product;
        }
    }

    //redirect back to original page
    header('Location:' . $return_url);
}

//remove item from shopping cart
if (isset($_GET["removep"]) && isset($_GET["return_url"]) && isset($_SESSION["products"])) {
    $product_code = $_GET["removep"]; //get the product code to remove
    $return_url = base64_decode($_GET["return_url"]); //get return url


    foreach ($_SESSION["products"] as $cart_itm) { //loop through session array var
        if ($cart_itm["code"] != $product_code) { //item does,t exist in the list
            $product[] = array('name' => $cart_itm["name"], 'code' => $cart_itm["code"], 'qty' => $cart_itm["qty"], 'price' => $cart_itm["price"], 'id' => $cart_itm["id"]);
        }

        //create a new product list for cart
        $_SESSION["products"] = $product;
    }

    //redirect back to original page
    header('Location:' . $return_url);
}
