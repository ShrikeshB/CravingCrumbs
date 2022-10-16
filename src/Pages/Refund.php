<?php

// included the DB connection file
include_once '../PHP/connectDB.php';
include_once '../PHP/Mail.php';
include_once('../PHP/Login/LoginChecker.php');
// to ignore notices
error_reporting(E_ALL ^ E_NOTICE);



session_start();

$UserId = $_SESSION['UserID'];

# checks whether the user has logged in
hasLoggedIn();

// used to fetch the userdetails
$Refunds_Query = "SELECT * FROM refund WHERE User_ID = '$UserId' AND Status='pending'";
$Refund_Result = mysqli_query($con, $Refunds_Query);

// used to fetch the userdetails
$RefundsDetails_Query = "SELECT * FROM refunddetails WHERE User_ID = '$UserId'";
$RefundsDetails_Result = mysqli_query($con, $RefundsDetails_Query);
$rd_row = mysqli_fetch_assoc($RefundsDetails_Result);



$amt = 0;
while ($Refund_Row = mysqli_fetch_array($Refund_Result)) {
  if ($Refund_Row == null)
    echo "<script>  history.back()</script>";
  $amt = $amt + $Refund_Row['Amt'];
}

if($amt <= 0){
  header("location:http://localhost/CakeSite/src/index.php");
}




if (isset($_POST['req'])) {



  $acc_Name = $_POST['acc_name'];
  $acc_No = $_POST['acc_no'];
  $ifsc = $_POST['ifsc'];
  $upi = $_POST['upi'];


  if ($acc_Name != null && $acc_No != null && $ifsc != null && $upi == null) {

    # here the accounts details are inserted!

    // insert query holder..
    $insert_Quert = "INSERT INTO refunddetails VALUES ('','$UserId', '$acc_Name', '$acc_No', '$ifsc', null)";
    // update query holder..
    $update_query = "UPDATE refunddetails SET Acc_Name='$acc_Name', Acc_No='$acc_No', IFSC='$ifsc', UPI=null WHERE User_ID='$UserId'";
  } else if ($upi != null && $acc_Name == null && $acc_No == null && $ifsc == null) {

    # here the upi details are inserted..


    // insert query holder..
    $insert_Quert = "INSERT INTO refunddetails VALUES ('','$UserId', null, null,null, '$upi')";
    // update query holder..
    $update_query = "UPDATE refunddetails SET Acc_Name=null, Acc_No=null, IFSC=null, UPI='$upi' WHERE User_ID='$UserId'";
  } else if ($acc_Name != null && $acc_No != null && $ifsc != null && $upi != null) {
    
    # if both the payment mode are selected then show the prompt
    echo "<script> alert('Please choose either one of payment mode'); history.back();</script>";
    die();
  } else {

    # if no data is added in input field then show the prompt
    echo "<script> alert('Please fill the details'); history.back();</script>";
    die();
  }

  // checks if the data is already present
  if ($rd_row) {
    # if the data is already present then update it...
    $result = mysqli_query($con, $update_query);
  } else {
    # if the there is no data then insert the fresh data...
    $result = mysqli_query($con, $insert_Quert);
  }



  if ($result) {
    echo "<script> alert('Refund Requested'); history.back();</script>";
  } else {
    echo "<script> alert('Refund Request failed!'); history.back();</script>";
  }
}


// echo "<script> window.location='http://localhost/CakeSite/src/index.php'; </script>";

// echo "<script> alert('Order failed!'); history.back()</script>";



?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Craving Crumbs | Refund</title>

  <!-- fav icon -->
  <link rel="icon" href="../../Icons/cake-white.png" type="image/x-icon" />

  <!-- css file linked-->
  <link rel="stylesheet" href="../Styles/payment/payment.css" />
  <link rel="stylesheet" href="../Styles/Refund/refund.css" />

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
          <h1>Refund</h1>

          <p>Refund Amount: <?php echo $amt ?></p>




        </div>
      </div>
      <div class="payment-method">
        <div class="Debit-card">
          <h1>Account Details</h1>


          <form action="http://localhost/CakeSite/src/Pages/Refund.php" method="post" >
            <div class="input-field">
              <label for="">Account Holder Name</label>
              <input type="text" id="" name="acc_name" value="<?php echo $rd_row['Acc_Name'] ?>" />

            </div>

            <div class="input-field">
              <label for="">Account No.</label>
              <input type="number" name="acc_no" value="<?php echo $rd_row['Acc_No'] ?>" />
            </div>

            <div class="input-field">
              <label for="">IFSC</label>
              <input type="text" name="ifsc" value="<?php echo $rd_row['IFSC'] ?>" />
            </div>

            <p style="margin-top: 1em;">OR</p>
            <div class="input-field">
              <label for="">UPI</label>
              <input type="text" name="upi" value="<?php echo $rd_row['UPI'] ?>" />
            </div>


            <input type="submit" name="req" value="Request Refund" />
          </form>
        </div>
      </div>
    </div>
  </section>
</body>
<script src="../JS/Nav-Bar/NavBar.js"></script>
<script>

</script>

</html>