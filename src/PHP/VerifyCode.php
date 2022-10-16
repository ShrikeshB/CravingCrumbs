<?php

# This file Verifies the verification code that been send to user's...
# here if verification is success then it will redirect to index.php(Home Page). 

session_start();

# //* if the verify BTN is click
if (isset($_POST['verify'])) {
    $Mailcode = $_SESSION['code'];// this is actual code send in mail.

    $code = $_POST['code'];// this is from code.html form.

    # here compares the mail code & form code.
    if ($code == $Mailcode) {

        // here if code is verfied for sign up form 
        if ($_SESSION['sign']){
            header("Location:http://localhost/CakeSite/src/PHP/Signup.php");
            $_SESSION['sign'] = false;
           unset( $_POST['code']);
        }
        else if($_SESSION['newPass']){ // here verifies for forgot password
            header("Location:http://localhost/CakeSite/src/Pages/Newpassword.php");
            $_SESSION['newPass'] = false;
            unset( $_POST['code']);
        }else{
            echo ("<script> history.go(-2); </script>");
        }
    } else if ($Mailcode == null) {
        // if the user tries to access this once the session data is delete 
        // then user will be redirected to forgot password page...
        echo  "<script> alert('Expired'); </script>";
        echo ("<script> history.go(-2); </script>");
    } else {
        // if the user code is invalid then user will redirect to previous page...
        echo  "<script> alert('invalid Code!'); </script>";
        echo ("<script> history.go(-1); </script>");
    }
} else {
    //* if the verify BTN is not clicked
    echo  "<script> alert('Something went wrong!'); </script>";
    echo ("<script> history.back(); </script>");
    //  echo ("<script>  history.replaceState(null, null, '/'); </script>");
}
