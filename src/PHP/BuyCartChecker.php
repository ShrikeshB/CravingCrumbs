<?php
# Used redirect to payment page after clicking on buy.

    // This file is used to check whether the user has demanded to add cake in cart or to buy
    // as it is not possible to check inside the Detail.php file
    // this file is not visible to users
    session_start();
    if (isset($_POST['buy']) && $_SESSION['isLogin']) {
        $_SESSION['cakeID']  = $_GET['CakeID'];
        $_SESSION['quantity'] = $_POST['quantity'];
        $_SESSION['msg'] = $_POST['msg'];
        $_SESSION['size'] = $_POST['radio-btn'];
            header("Location:http://localhost/CakeSite/src/Pages/Payment.php"); // redirect to your desired page


     }else if (isset($_POST['cart']) && $_SESSION['isLogin']) {
       // header("Location: http://localhost/CakeSite/src/PHP/Cart.php"); // redirect to your desired page
     }else{
        echo "<script> window.location='../Pages/Login.html' </script>";
     }
?>