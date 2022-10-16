<?php
session_start();
function hasLoggedIn(){
    if (!$_SESSION['isLogin']) {
        header("location:http://localhost/CakeSite/src/Pages/Login.html");
      }
}