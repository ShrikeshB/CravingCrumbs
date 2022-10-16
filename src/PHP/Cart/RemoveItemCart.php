<?php
// to ignore notices
error_reporting(E_ALL ^ E_NOTICE);

// included the DB connection file
include_once '../../PHP/connectDB.php';
$cartID = $_GET['cartID'];
$del_query = "DELETE FROM cart WHERE Cart_ID=$cartID";
$result = mysqli_query($con,$del_query);

echo "<script> history.back() </script>";