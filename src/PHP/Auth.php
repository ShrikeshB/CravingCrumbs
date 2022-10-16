<?php
// included the DB connection file
include_once '../PHP/connectDB.php';
session_start();
//!------------ Sign in process  ---------------------------
if (isset($_POST['signin'])) {

  $Email = $_POST['email'];
  $Uname = $_POST['uname'];
  $Password = $_POST['password'];

  $query = "SELECT * FROM auth WHERE Email='$Email'";
  $Checker_result = mysqli_query($con, $query);
  $row = mysqli_fetch_assoc($Checker_result);

  // checks for email already exists..
  // if ($row) {
  //   echo  "<script> alert('Email already Exists'); </script>";
  //   echo ("<script> history.back(); </script>");
  // } else {



  //   // this query will store the new user details
  //   $SignIn_Query = "INSERT INTO Auth VALUES ('','$Uname','$Email','$Password ','1')";
  //   $Result_Of_SignIn = mysqli_query($con, $SignIn_Query);



  //   // check whether the user signed in sucessfully
  //   if ($Result_Of_SignIn) {

  //     // this query will fetch the new signed in user ID 
  //     $GetLastUserID_Query = "SELECT * FROM auth where User_ID=(select max(User_ID) from auth)";
  //     $result_LastID = mysqli_query($con, $GetLastUserID_Query);
  //     $row = mysqli_fetch_assoc($result_LastID);
  //     $LeastID = $row['User_ID'];
  //     $_SESSION["UserID"] = $LeastID;
  //     $_SESSION['Form'] = "signed";
  //   //  echo "<script>window.location.replace('http://localhost/CakeSite/src/index.php'); </script>";
  //   } else
  //     echo ("<script> history.back(); </script>");
  // }
}


//!------------ Login  ---------------------------
else if (isset($_POST['login'])) {

  $Email = $_POST['email'];
  $Password = $_POST['password'];

  $LogIN_Query1 = "SELECT * FROM auth WHERE Email = '$Email'";
  $Result_Of_Login1 = mysqli_query($con, $LogIN_Query1);
  while ($row = mysqli_fetch_array($Result_Of_Login1)) {
    $verify = password_verify($Password, $row['Password']);


    if ($verify) {
      $LeastID = $row['User_ID'];
      $_SESSION["UserID"] = $LeastID;

      // update the logout_status
      $Update_Auth_Query = "UPDATE Auth SET Logout_Status = '1' WHERE User_ID = '$LeastID'";
      $result_Auth_update = mysqli_query($con, $Update_Auth_Query);
      if ($result_Auth_update) {
        $_SESSION['Form'] = "Login";
        echo "<script>window.location.replace('http://localhost/CakeSite/src/index.php'); </script>";
        $_SESSION['isLogin'] = false;
      }
    } else {
      echo  "<script> alert('Wrong Email/Password'); </script>";
      echo ("<script> history.back(); </script>");
    }
  }

  if (!$verify) {
    echo  "<script> alert('Wrong Email/Password'); </script>";
    echo ("<script> history.back(); </script>");
  }






  // $LogIN_Query = "SELECT * FROM auth WHERE Email = '$Email'";
  // $Result_Of_Login = mysqli_query($con, $LogIN_Query);
  // $row = mysqli_fetch_assoc($Result_Of_Login);
} else {
  echo ("<script> history.back(); </script>");
  //  echo ("<script>  history.replaceState(null, null, '/'); </script>");
}
