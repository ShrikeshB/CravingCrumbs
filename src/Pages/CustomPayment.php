<?php

# File is for payment of custom cakes

// included the DB connection file
include_once '../PHP/connectDB.php';
include_once '../PHP/Mail.php';
// to ignore notices
error_reporting(E_ALL ^ E_NOTICE);
session_start();

$UserId = $_SESSION['UserID'];
$CustCakeID = $_GET['CustID'];


// used to fetch the userdetails
$UserDetails_Query = "SELECT * FROM userdetails WHERE User_ID = '$UserId'";
$UserDetails_Result = mysqli_query($con, $UserDetails_Query);
$User_Row = mysqli_fetch_assoc($UserDetails_Result);

$auth_Query = "SELECT * FROM auth WHERE User_ID = '$UserId'";
$auth_Result = mysqli_query($con, $auth_Query);
$auth_Row = mysqli_fetch_assoc($auth_Result);

// check whether the user is logged in
if (!$User_Row) {
  header("Location:http://localhost/CakeSite/src/Pages/UserAccount.php");
  die();
}

// used to fetch the cake info
$Cake_Query = "SELECT * FROM customcakeorders WHERE User_ID='$UserId' AND Custom_Cake_ID = '$CustCakeID'";
$Cake_Result = mysqli_query($con, $Cake_Query);
$Cake_Row = mysqli_fetch_assoc($Cake_Result);



$Qunatity = $Cake_Row['Quantity'];
$Size = $Cake_Row['Size'];
$Message = $Cake_Row['Message'];
$ExpectinOn = $Cake_Row['Arriving'];

if (isset($_POST['pay'])) {
  // date from user card expiry...
  $date = $_POST['date'];
  // system current date...
  $currentDate = date("Y-m");

  // verifies whether the card is expired or not
  if ($date <= $currentDate) {
    echo "<script> alert('your card is expired'); </script>";
    echo "<script> history.back() </script>";
    die();
  }


  // fetch the current system date.
  date_default_timezone_set("Asia/Calcutta");
  $orderedTime = $date = date('Y-m-d H:i:s');

  // query for updating th payment status to 'completed' 
  $update_query = "UPDATE customcakeorders SET Payment_Status = 'completed',TimeOfOrder='$orderedTime' WHERE User_ID = '$UserId' AND Custom_Cake_ID = '$CustCakeID'";
  $Result_update = mysqli_query($con, $update_query);
  if ($Result_update) {
  

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
          <td>custom cake</td>
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

      <tr>
        <tr class='ar'>
          <th >Arrving on:</th>
          <td><b>'$ExpectinOn'</b></td>
        </tr>
      </table>
    </div>
    <h2>Thanks for ordering cake from Craving Crumbs</h2>
  </section>
</body>
</html>

    ";


    // here is mail sending function...
     sendMail($auth_Row['Email'], 'Order Placed!', $body);
 
     echo "<script> alert('Order Placed'); </script>";

    echo "<script> window.location='http://localhost/CakeSite/src/index.php'; </script>";
  } else {
   echo "<script> alert('Order failed!'); </script>";
  
  // echo 'error'. mysqli_error($con);
  }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Craving Crumbs | Payment</title>

  <!-- fav icon -->
  <link rel="icon" href="../../Icons/cake-white.png" type="image/x-icon" />

  <!-- css file linked-->
  <link rel="stylesheet" href="../Styles/payment/payment.css" />

  <!-- respnosive file linked -->
  <link rel="stylesheet" href="../Styles/payment/Resp/paymentResp.css" />
</head>

<body>
  <div class="logo"> <img src="../../Images/Component_Img/Logo.png" alt=""> </div>
  <!-- //! ------------- payment-section ---------------------- -->
  <section class="payment-section">
    <div class="container">
      <div class="info">

        <div class="billing-info">
          <h1>Billing Info</h1>

          <table>
            <tr>
              <td>Cake: </td>
              <td>
                <p>Custom Cake</p>
              </td>
            </tr>
            <tr>
              <td>Quantity:</td>
              <td>
                <p> <?php echo $Cake_Row['Quantity'] ?></p>
              </td>
            </tr>

            <tr>
              <td>Size:</td>
              <td>
                <p> <?php echo $Cake_Row['Size'] ?></p>
              </td>
            </tr>

            <tr>
              <td>Message:</td>
              <td>
                <p> <?php echo $Cake_Row['Message'] ?></p>
              </td>
            </tr>
            <tr>
              <td>Arriving on:</td>
              <td>
                <p> <?php echo $Cake_Row['Arriving']; ?></p>
              </td>
            </tr>

            <tr>
              <td>Price:</td>
              <td>
                <p> <?php echo $Cake_Row['Price']; ?></p>
              </td>
            </tr>
          </table>





        </div>
        <div class="delivery-info">
          <h1>Delivery Info</h1>

          <table>
            <tr>
              <td>State: </td>
              <td>
                <p> <?php echo $User_Row['State'] ?></p>
              </td>
            </tr>

            <tr>
              <td>City:</td>
              <td>
                <p> <?php echo $User_Row['City'] ?></p>
              </td>
            </tr>

            <tr>
              <td>Pincode:</td>
              <td>
                <p> <?php echo $User_Row['Pincode'] ?></p>
              </td>
            </tr>

            <tr>
              <td>Address:</td>
              <td>
                <p> <?php echo $User_Row['Address'] ?></p>
              </td>
            </tr>
          </table>
        </div>
      </div>
      <div class="payment-method">


        <div class="pay-container">
          <div class="Debit-card">
            <h1>Payment</h1>
            <div class="arrow-btn">
              <img src="../../Icons/Arrow.png" alt="">
            </div>
            <!-- img-holder -->
            <div class="img-container">
              <img src="../../Images/Pays/cards.png" alt="" />
            </div>
            <form action="http://localhost/CakeSite/src/Pages/CustomPayment.php?CustID=<?php echo $CustCakeID ?>" method="post">
              <div class="input-field">
                <label for="">Card No.</label>
                <input type="text" required name="" pattern="[0-9]{4}" id="" placeholder="16 digit no." />

              </div>
              <div class="input-field">
                <label for="">CVV.</label>
                <input type="password" required name="" id="" pattern="[0-9]{3}" />
              </div>

              <div class="input-field">
                <label for="">Card expiry date</label>
                <!-- pattern="([0-9]{4,4})-([0-9]{2,2})-([0-9]{2,2})" -->
                <input type="month" placeholder="yyyy-mm-dd" required onchange="" name="date" id="" />
              </div>

              <input type="submit" name="pay" value="Pay now" />
            </form>
          </div>

          <div class="upi-payment">
            <h1>Payment</h1>
            <div class="arrow-btn reverse-arrow">
            <img src="../../Icons/Arrow.png" alt="">

            </div>
            <!-- img-holder -->
            <div class="img-container">
              <img src="../../Images/Pays/Capture.png" alt="" />
            </div>
            <center> <img class="qr-code" src="../../Images/Pays/QR.png" alt="" /></center>
          </div>

        </div>
      </div>
  
    </div>
  </section>
</body>
<script src="../JS/Nav-Bar/NavBar.js"></script>
<script src="../JS/Payment/payment.js"></script>
<script>

</script>

</html>