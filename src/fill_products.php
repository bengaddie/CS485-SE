<?php
include_once("config.php");

// next, insert the tuples in the tables
//$fill_employee = "INSERT INTO products (product_code, product_name, product_desc, product_img_name, price)
//VALUES ('GM1000', 'Mario', 'Work together with your friends or compete for the crown in the first multiplayer 3D Mario game for the Wii U console. In the Super Mario 3D World game, players can choose to play as Mario, Luigi, Princess Peach or Toad', 'mario.jpg', '59.99');";
$fill_employee1 = "INSERT INTO orders (u_id, i_id, order_date, delivery_date)
VALUES ('4', '2','','');";
$fill_employee2 = "INSERT INTO products (product_code, product_name, product_desc, product_img_name, price)
VALUES ('GM1002', 'Monopoly', 'Own it all as a high-flying trader in the fast-paced world of real estate. Tour the city for the hottest properties: sites, stations and utilities are all up for grabs. Invest in houses and hotels, then watch the rent come pouring in!', 'monopoly.jpg','14.99');";
$fill_employee3 = "INSERT INTO products (product_code, product_name, product_desc, product_img_name, price)
VALUES ('GM1003', 'Clue', 'CLUE is the classic mansion murder game with a second crime scene. It is up to you to crack the case! Question everything to unravel the mystery. Who did it? Where? And with what weapon? Solve the murder first to win!','clue.jpg','9.99');";
$fill_employee4 = "INSERT INTO products (product_code, product_name, product_desc, product_img_name, price)
VALUES ('TY1000', 'Ninja Turtle', 'New York City. Crime rates are on the rise and innocent civilians tremble in fear. But there is a force fighting back, vigilantes among us ready to protect the city. Are they the heroes we expect them to be?','NTurtle.jpg','12.59');";
//$fill_employee5 = "INSERT INTO products (product_code, product_name, product_desc, product_img_name, price)
//VALUES ('TY1001', 'Rubber Duck', 'A rubber Duck', 'Duck.jpg', '100.99')";

if ($mysqli->multi_query($fill_employee1) === TRUE) {
    echo "New records created successfully <br>  ";
} else {
    echo "Error: " . $fill_employee3 . "<br>" . $mysqli->error;
}


if ($mysqli->multi_query($fill_employee2) === TRUE) {
    echo "New records created successfully <br>   ";
} else {
    echo "Error: " . $fill_employee4 . "<br>" . $mysqli->error;
}



?>