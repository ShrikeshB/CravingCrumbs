<?php

// to ignore notices
error_reporting(E_ALL ^ E_NOTICE);

// included the DB connection file
include_once '../../src/PHP/connectDB.php';
include_once '../../src/PHP/Mail.php';

$orderID = $_GET['CustOrderID'];


$result = mysqli_query($con, "SELECT * FROM customcakeorders WHERE Custom_Cake_ID = '$orderID' AND Status='pending'");
$matchFound = mysqli_fetch_assoc($result);
if (!$matchFound) {
    echo "<script> history.back() </script>";
    die();
}


$query = "UPDATE  customcakeorders SET Status='Rejected' WHERE Custom_Cake_ID='$orderID'";
$result = mysqli_query($con, $query);
if ($result) {

    echo "<script> alert('Order cancelled!') </script>";

    $cakeName = "Custom Cake";
    $Qunatity = $matchFound['Quantity'];
    $Size = $matchFound['Size'];
    $Message = $matchFound['Message'];


    $uid = $matchFound['User_ID'];
    $auth_query = "SELECT * FROM auth WHERE User_ID = $uid";
    $auth_result = mysqli_query($con, $auth_query);
    $auth = mysqli_fetch_assoc($auth_result);


    $email = $auth['Email'];
    $subject = "custom cake order Rejected!";

    $body = "
    
    <html>
<head>
  
</head>
<body>
  <section>

    <div>
    <p>Sorry we cannot accept this custom cake order as we are facing difficulties to understand the need.. </p>
      <table style='text-align: left;' cellspacing='15px' cellpadding='5px'>
        <tr>
          <th>Cake Name:</th>
          <td>'$cakeName'</td>
        </tr>
        <tr>
          <th>Cake Quantity:</th>
          <td>'$Qunatity'</td>
        </tr>
    
        <tr>
          <th>Cake size:</th>
          <td>'$Size'</td>
        </tr>
        <tr>
          <th>Message on cake:</th>
          <td>'$Message'</td>
        </tr>

      
     
      </table>
    </div>

    <h2>Sorry for inconveniences</h2>
  </section>
</body>
</html>

    ";



    sendMail($email, $subject, $body);
    echo "<script> history.back() </script>";
}
