<?php
// to ignore notices
error_reporting(E_ALL ^ E_NOTICE);
// included the DB connection file
include_once '../PHP/connectDB.php';
session_start();


$email = $_SESSION['email'];
if($email != null){
  if(isset($_POST['submit'])){
    $newPassword = $_POST['password'];
   

    $EncryptPassword = password_hash($newPassword, 
          PASSWORD_DEFAULT);

    $UpdatePassword = "UPDATE auth SET Password='$EncryptPassword'  WHERE Email='$email'";
    $result = mysqli_query($con, $UpdatePassword);
 
    // used to fetch the user ID
    $query = "SELECT * FROM auth WHERE email='$email'";
    $result2 = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($result2);

    // used to update the user logout status
    $Update_Auth_Query = "UPDATE Auth SET Logout_Status = '1' WHERE Email='$email'";
    $result_Auth_update = mysqli_query($con, $Update_Auth_Query);

    if($email == null){
      echo  "<script> alert('New password created'); </script>";
    }
  
    if($result){
      echo  "<script> alert('New password created'); </script>";
      session_unset();
      session_destroy();
      session_start();
      $_SESSION['isLogin'] = "hello1";
      $_SESSION['UserID'] = $row['User_ID'];
    
      
     header("Location:http://localhost/CakeSite/src/index.php");
  
    }else{
      echo ("<script> alert('Failed to create new password'); </script>");
    }
  }
}else{
  //echo 'back to login';
  header("Location: ./Login.html");
}

?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Craving Crumb | Forgot Password</title>

    <!-- fav icon -->
    <link rel="icon" href="../../Icons/cake-white.png" type="image/x-icon" />

    <!-- css linked -->
    <link rel="stylesheet" href="../Styles/ForgorPassword/Forgot.css" />
    <!-- auth responsiveness behaviour -->
    <link rel="stylesheet" href="../Styles/Login/Resp/AuthResp.css" />
  </head>
  <body>
    <form action="http://localhost/CakeSite/src/Pages/Newpassword.php" method="post">
      <div class="container">
        <div class="cust-form">
          <h1>Create new password</h1><br>
          <div class="input-field">
            <label>password</label>
            <input name="password" type="password" required />
          </div>

          <input type="submit" value="submit" name="submit" class="btn cust-submit-btn">
        </div>
      </div>
    </form>
  </body>
</html>