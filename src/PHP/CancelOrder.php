<?php
// to ignore notices
error_reporting(E_ALL ^ E_NOTICE);

// included the DB connection file
include_once '../PHP/connectDB.php';
include_once '../PHP/Mail.php';

session_start();
$OrderID = $_GET['OrderID'];
$CustOrderID = $_GET['CustOrderID'];
$UserID = $_SESSION['UserID'];



if ($OrderID != null) {
  $result = mysqli_query($con, "SELECT * FROM orders as o INNER JOIN cakes as c ON o.Cake_id=c.Cake_ID WHERE Order_ID = $OrderID");
  $matchFound = mysqli_fetch_assoc($result);


  if (!$matchFound) {
    echo "<script> history.back() </script>";
    die();
  }

  $cid = $matchFound['Cake_id'];

  $result_cake = mysqli_query($con, "SELECT * FROM cakes WHERE Cake_ID = $cid");
  $cake = mysqli_fetch_assoc($result_cake);

  $cakeName = $cake['Cake_Name'];
  $Qunatity = $matchFound['Quantity'];
  $Size = $matchFound['Size'];
  $Message = $matchFound['Message'];
  // $UserId = $matchFound['User_ID'];
  $cake_price = $matchFound['Amt'];




  // $del_query = "DELETE FROM orders WHERE Order_ID='$OrderID'";
  $update_query = "UPDATE orders SET Cancel_Status = 'cancelled' WHERE Order_ID='$OrderID'";

  # used to insert the data into refund table where customcakeID is null
  $Refund_result = mysqli_query($con, "INSERT INTO refund VALUES('','$UserID','$cid',null,$OrderID,'$cake_price','pending')");
} else if ($CustOrderID != null) {

  # If the custom cake canellation is required then execute this part of code..
  $result = mysqli_query($con, "SELECT * FROM customcakeorders WHERE Custom_Cake_ID = '$CustOrderID' ");
  $matchFound = mysqli_fetch_assoc($result);

  if (!$matchFound) {
    echo "<script> history.back() </script>";
    die();
  }

  // $UserId = $matchFound['User_ID'];
  $cid = $matchFound['Custom_Cake_ID'];

  $cakeName = "Custom Cake";
  $Qunatity = $matchFound['Quantity'];
  $Size = $matchFound['Size'];
  $Message = $matchFound['Message'];

  $cake_price = $matchFound['Price'];
  //$update_query = "DELETE FROM customcakeorders WHERE Custom_Cake_ID='$CustOrderID'";
  $update_query = "UPDATE customcakeorders SET Cancel_Status = 'cancelled' WHERE Custom_Cake_ID='$CustOrderID'";


  // checks if order payment is completed then only add the data to refund table..
  if ($matchFound['Payment_Status'] == 'completed') {

    # used to insert the data into refund table where customcakeID is null
    $Refund_result = mysqli_query($con, "INSERT INTO refund VALUES('','$UserID',null,'$cid',null,'$cake_price','pending')");

    
  }
}


$result = mysqli_query($con, $update_query);
$uid = $matchFound['User_ID'];
$auth_query = "SELECT * FROM auth WHERE User_ID = $uid";
$auth_result = mysqli_query($con, $auth_query);
$auth = mysqli_fetch_assoc($auth_result);
if ($result) {
  echo "<script> alert('Order cancelled!') </script>";
  $email = $auth['Email'];
  $subject = "Your Order Cancelled!";

  $body = "
    
    <html>
<head>
  
</head>
<body>
  <section>

    <div>

        <h1>Your order details</h1>
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
    <h2>Have a good day</h2>
  </section>
</body>
</html>

    ";




  sendMail($email, $subject, $body);
  echo "<script> history.back() </script>";


  // header("Location: http://localhost/CakeSite/src/Pages/Orders.php");
} else {
  echo "<script> alert('Order cancellation failed!'); history.back()</script>";
}
