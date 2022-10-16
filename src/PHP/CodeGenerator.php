<?php

/* 
    * This file will generate the verification code for forgot password.
    * and send the code mail to the user..
    * Here 
*/
# included the DB connection file
include_once '../PHP/connectDB.php';
include_once '../PHP/Mail.php';
session_start();
# to generate the verification code..
# here code is generated for forgot password..
if (isset($_POST['submit'])) {

    $email = $_POST['email'];
    $query = "SELECT * FROM auth WHERE Email='$email'";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($result);
    $_SESSION['newPass'] = true;
    if ($row) {

        $_SESSION['code'] = $code = rand(100000, 999999);
        $_SESSION['email'] = $_POST['email'];



        // Email Details
        $to_email = $email;
        $subject = "Verification Code!";
        $body = "Code=" . $code . "\n Do not share with anyone!";
        $headers = "From: CravingCrumbs.cakes@gmail.com";
        // echo 'remove comments to send email';

        // delete the below code 
        header("Location:../Pages/code.html");

        if (mail($to_email, $subject, $body, $headers)) {
            //    echo "Email successfully sent to $to_email...";
            header("Location:../Pages/code.html");
        } else {
            echo "<script> alert('Failed to the send code, Try again'); </script>";
        }
    } else {
        // if email doesn;t exist in DB..
        echo  "<script> alert('Email do not exist'); </script>";
        echo ("<script> history.back(); </script>");
    }
}
# Here code is generated for sign up.
# here also check whether the email is already exists.
else if (isset($_POST['signin'])) {



    $email = $_POST['email'];
    $_SESSION['email'] = $_POST['email'];
    $_SESSION['password'] = $_POST['password'];
    $_SESSION['uname'] = $_POST['uname'];

    $query = "SELECT * FROM auth WHERE Email='$email'";
    $Checker_result = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($Checker_result);

    if ($row) {
        echo  "<script> alert('Email already Exists'); </script>";
        echo ("<script> history.back(); </script>");
        die();
    }



    $_SESSION['code'] = $code = rand(100000, 999999);
    $_SESSION['sign'] = true;

     sendMail($email, 'verification', 'Verification code:' . $code);



    

    
    header("Location:../Pages/code.html");
    // header("Location:../Pages/code.html?code=" . $code);


} else {
    echo ("<script> history.back(); </script>");
    //  echo ("<script>  history.replaceState(null, null, '/'); </script>");
}
