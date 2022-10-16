<?php
// to ignore notices
error_reporting(E_ALL ^ E_NOTICE);

// included the DB connection file
include_once '../PHP/connectDB.php';
session_start();
// fetch userid from cookie
$UserID = $_SESSION["Cookie_UserID"];

$Update_Auth_Query = "UPDATE Auth SET Logout_Status = '0' WHERE User_ID = '$UserID'";
$result_Auth_update = mysqli_query($con,$Update_Auth_Query);
if($result_Auth_update)
    echo 'update';
else
    echo 'failed';

    $_SESSION['isLogin'] = false;


session_unset();
session_destroy();

 header("location:http://localhost/CakeSite/src/index.php");


 exit();


