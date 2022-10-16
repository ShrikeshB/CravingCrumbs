<?php

// to ignore notices
error_reporting(E_ALL ^ E_NOTICE);

// included the DB connection file
include_once '../../src/PHP/connectDB.php';

if (isset($_POST['submit'])) {
    $cakeName = $_POST['CakeName'];
    $cakeType = $_POST['CakeType'];
    $cakeFlavor = $_POST['CakeFlavor'];
    $toppings = $_POST['Toppings'];
    $breadType = $_POST['BreadType'];
    $category = $_POST['category'];
    $price = $_POST['price'];
    $price1 = $_POST['price1kg'];
    $price15 = $_POST['price15kg'];
    $price2 = $_POST['price2kg'];


    $deliveryTime = $_POST['deliveryTime'];
    $cakeShape = $_POST['cake-shape'];
    $tags = $_POST['Tags'];

    $cakeID = $_GET['cakeID'];
    $creamType = $_POST['creamType'];
    $file = $_FILES['cake-img'];
    $fileName = $_FILES['cake-img']['name'];
    if ($file != null &&  $fileName != null) {


        // image data
        $file = $_FILES['cake-img'];
        $fileName = $_FILES['cake-img']['name'];
        $tmp_name = $_FILES['cake-img']['tmp_name'];
        $fileType = $_FILES['cake-img']['type'];
        $error = $_FILES['cake-img']['error'];

        $destination = '../../Uploaded-Img/Cakes/' . $category . '/' . $fileName;

        // used to upload images
        if (move_uploaded_file($tmp_name, $destination)) {
            echo "<script> console.log('uploaded') </script>";
        } else {
            echo "<script> console.log('failed to upload') </script>";
        }

        // query to update..
        $update_query = "UPDATE cakes SET 
    Cake_Img='$fileName',
    Cake_Name='$cakeName',
    Price='$price',
    PriceOf1='$price1',
    PriceOf1_5='$price15',
    PriceOf2='$price2',     


     Cake_Flavors='$cakeFlavor',
     Cake_Type='$cakeType',
     Cream_Type='$creamType',
     Toppings='$toppings',
     Bread_Type='$breadType',
     Cake_Shape='$cakeShape',
     Category='$category',
     Order_Time='$deliveryTime',
     Tags='$tags'  
    WHERE Cake_ID='$cakeID'";
    } else {
        // query to update..

        $update_query = "UPDATE cakes SET 
    Cake_Name='$cakeName',
     Price='$price',
     PriceOf1='$price1',
     PriceOf1_5='$price15',
PriceOf2='$price2',
     Cake_Flavors='$cakeFlavor',
     Cake_Type='$cakeType',
     Cream_Type='$creamType',
     Toppings='$toppings',
     Bread_Type='$breadType',
     Cake_Shape='$cakeShape',
     Category='$category',
     Order_Time='$deliveryTime',
     Tags='$tags'  

    WHERE Cake_ID='$cakeID'";
    }


    $result = mysqli_query($con, $update_query);
    if ($result) {
        echo 'updated';

        echo '<script>alert("Changes saved"); history.back()</script>';
    } else {
        echo 'failed';
        echo mysqli_error($con);
    }
} else {
    echo '<script> history.back()</script>';
}
