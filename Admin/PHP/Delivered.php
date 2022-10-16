<?php
// to ignore notices
error_reporting(E_ALL ^ E_NOTICE);

// included the DB connection file
include_once '../../src/PHP/connectDB.php';
include_once '../../src/PHP/Mail.php';

// echo "<td><a href='delete.php?id=".$query2['id']."' onClick=\"javascript:return confirm('are you sure you want to delete this?');\">x</a></td><tr>";




$auth_result = mysqli_query($con, "SELECT * FROM auth WHERE User_ID='$UserId'");
$auth_row = mysqli_fetch_assoc($auth_result);

$OrderID = $_GET['orderID'];
$CustID = $_GET['CustOrderID'];

if ($OrderID != null){
    $match_query = "SELECT * FROM orders INNER JOIN cakes ON orders.Cake_id=cakes.Cake_ID WHERE Order_ID='$OrderID'";
    $query = "UPDATE orders SET Delivery_Status='Delivered' WHERE Order_ID='$OrderID'";
}
 
else if ($CustID  != null){
    $match_query = "SELECT * FROM customcakeorders WHERE Custom_Cake_ID='$CustID'";
    $query = "UPDATE customcakeorders SET Delivery_Status='Delivered' WHERE Custom_Cake_ID='$CustID'";
}



$match_result = mysqli_query($con, $match_query);
$match_row = mysqli_fetch_assoc($match_result);
$UserId = $match_row['User_ID'];

$result = mysqli_query($con, $query);
if ($result) {



  
    $Qunatity = $match_row['Quantity'];
    $Size = $match_row['Size'];
    $Message = $match_row['Message'];


    $uid = $match_row['User_ID'];
    $auth_query = "SELECT * FROM auth WHERE User_ID = $UserId";
    $auth_result = mysqli_query($con, $auth_query);
    $auth = mysqli_fetch_assoc($auth_result);


    $email = $auth['Email'];

    if ($OrderID != null){
        $cakeName =  $match_row['Cake_Name'];
    }else if ($CustID  != null){
        $cakeName = "Custom Cake";
    }


    $subject = "Your Order Been Delivered!";

    $body = "
    
    <html>
<head>
  
</head>
<body>
  <section>

    <div>

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

    <h2>Visit Again Thank you!</h2>
  </section>
</body>
</html>

    ";



    sendMail($email, $subject, $body);




    echo "<script> alert('Order Delivered'); </script>";
    if ($OrderID != null)
        header("Location:http://localhost/CakeSite/Admin/Pages/Orders.php");
    else
        header("Location:http://localhost/CakeSite/Admin/Pages/CustomOrders.php");
} else {
    echo "<script> alert('something went wrong!'); history.back(); </script>";
}
