<?php
session_start();
 $_SESSION['IsAdminLogged'] = false;
header("Location:http://localhost/CakeSite/Admin/Pages/Login.html");