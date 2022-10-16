<?php
session_start();

# to ignore notices
error_reporting(E_ALL ^ E_NOTICE);

# included the DB connection file
include_once '../../src/PHP/connectDB.php';


if(isset($_POST['login'])){
    $email = $_POST['email'];
    $password=$_POST['password'];
    $query = "SELECT * FROM admin WHERE (Email='$email' OR Username='$email') AND Password='$password'";
    $result = mysqli_query($con,$query);
    $row = mysqli_fetch_assoc($result);
    if($row != null){
        echo 'login';
        $_SESSION['IsAdminLogged'] = true;
        $_SESSION['AdminID'] = $row['Admin_ID'];
        header("Location:http://localhost/CakeSite/Admin/Pages/Dashboard.php");
    }else{
        echo "<script> alert('Login Failed ');</script> ";
        echo "<script> history.go(-1);</script> ";
    }
}else{
    echo "<script> history.go(-1);</script> ";
}