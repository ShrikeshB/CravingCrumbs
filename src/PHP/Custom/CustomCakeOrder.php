<?php

# this file is used to only store the order details...
# This file not display the UI..



session_start();
// to ignore notices
error_reporting(E_ALL ^ E_NOTICE);

// included the DB connection file
include_once '../../../src/PHP/connectDB.php';

$uid = $_SESSION['UserID'];
// fetch the current system date.
date_default_timezone_set("Asia/Calcutta");
$orderedTime = $date = date('Y-m-d H:i:s');


if (isset($_POST['submit'])) {


    # used to checl whether the user has entered his/her data..
    # if no then redirect to user account detail page..
    // used to fetch the userdetails
    $UserDetails_Query = "SELECT * FROM userdetails WHERE User_ID = '$uid'";
    $UserDetails_Result = mysqli_query($con, $UserDetails_Query);
    $User_Row = mysqli_fetch_assoc($UserDetails_Result);

    // check whether the user is logged in
    if (!$User_Row) {
        header("Location:http://localhost/CakeSite/src/Pages/UserAccount.php");
        die();
    }

    // image data
    $file = $_FILES['cake-img'];
    $fileName = $_FILES['cake-img']['name'];
    $tmp_name = $_FILES['cake-img']['tmp_name'];
    $fileType = $_FILES['cake-img']['type'];
    $error = $_FILES['cake-img']['error'];

    $destination = '../../../Uploaded-Img/Custom-Cake/' . $fileName;


    // form data
    $cakeType = $_POST['cake-type'];
    $creamType = $_POST['cream-type'];
    $toppings = $_POST['toppings'];
    $breadType = $_POST['bread-type'];
    $cakeShape = $_POST['cake-shape'];
    $cakeFlavor = $_POST['cake-flavor'];
    $cakeName = $_POST['cake-name'];
    $message = $_POST['message'];
    $quantity = $_POST['quantity'];
    $size = $_POST['radio-btn'];
    $date = $_POST['date'];

    $currentDate = date("Y-m-d");


    if ($date <= $currentDate) {
        echo "<script> alert('Delivery is not possible'); </script>";
        echo "<script> history.back() </script>";
        die();
    }


    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));


    $allowed = array('jpg', 'jpeg', 'png', 'webp');
    if (in_array($fileActualExt, $allowed)) {
        if ($error === 0) {
            $fileNameNew = 'User-' . $uid . '-' . uniqid('', true) . '.' . $fileActualExt; //create uni id
            // $destination = 'Uploads/' . $fileNameNew;
            $destination = '../../../Uploaded-Img/Custom-Cake/' . $fileNameNew;

            if (move_uploaded_file($tmp_name, $destination)) {
                echo ' uploaded';
            } else {
                echo 'failed to upload';
            }
        } else {
            echo 'error in file';
        }
    } else {
        echo 'cannot upload this type..';
    }

    // upload details here...
    $Insert_Query = "INSERT INTO customcakeorders VALUES('',
    '$uid',
    '$fileNameNew',
    '$cakeFlavor',
    '$cakeType',
    '$creamType',
    '$toppings',
    '$breadType',
    '$cakeShape',
    '$quantity',
    '$size',
    '$message',
    'pending',
    'pending',
    'pending',
    '$date',
    '$orderedTime',
    'pending',
    'none'
    )";

    $Result = mysqli_query($con, $Insert_Query);
    if ($Result)

        echo "<script> alert('Your has been resquested!'); history.back() </script>";
    else
        echo 'failed';
}
