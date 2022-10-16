<?php
# used to insert the cart data...
# takes data from details.php

// included the DB connection file
include_once '../PHP/connectDB.php';

// to ignore notices
error_reporting(E_ALL ^ E_NOTICE);
session_start();

$CakeID = $_GET['cakeID'];
$uid = $_SESSION['UserID'];

// check whether the item is in cart or not
$cart_query = "SELECT * FROM cart WHERE User_ID=$uid AND Cake_ID=$CakeID";
$cart_result = mysqli_query($con, $cart_query);
$cart_row = mysqli_fetch_assoc($cart_result);

// if the cake is already inside cart then it will redirect to previous page
if($cart_row){
    echo "<script> history.back() </script>";
}else{
    $q = "INSERT INTO cart VALUES('','$uid','$CakeID')";
    $result = mysqli_query($con, $q);
}




if ($result)
    echo "<script> history.back() </script>";
else {
    echo "<script> history.back() </script>";
}
