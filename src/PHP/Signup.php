<?php

# This file is meant to insert the sign iin data only..
# Here pass is encrypted..


// included the DB connection file
include_once '../PHP/connectDB.php';
session_start();

$Email = $_SESSION['email'];
$Uname = $_SESSION['uname'];
$Password = $_SESSION['password'];

$EncryptPassword = password_hash($Password, 
          PASSWORD_DEFAULT);

      

  // this query will store the new user details
  $SignIn_Query = "INSERT INTO Auth VALUES ('','$Uname','$Email','$EncryptPassword','1')";
  $Result_Of_SignIn = mysqli_query($con, $SignIn_Query);

  // check whether the user signed in sucessfully
  if ($Result_Of_SignIn) {

    // this query will fetch the new signed in user ID 
    $GetLastUserID_Query = "SELECT * FROM auth where User_ID=(select max(User_ID) from auth)";
    $result_LastID = mysqli_query($con, $GetLastUserID_Query);
    $row = mysqli_fetch_assoc($result_LastID);
    $LeastID = $row['User_ID'];
    $_SESSION["UserID"] = $LeastID;
    $_SESSION['Form'] = "signed";
    header("Location:http://localhost/CakeSite/src/index.php");
} else{
    echo ("<script> history.back(); </script>");
}

