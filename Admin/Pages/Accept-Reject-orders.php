<?php

#custom cake dashboard page


// to ignore notices
error_reporting(E_ALL ^ E_NOTICE);

// included the DB connection file
include_once '../../src/PHP/connectDB.php';
include_once '../../src/PHP/CharLimits/CharLimits.php';
include_once '../../src/PHP/Mail.php';

session_start();
if( !$_SESSION['IsAdminLogged']){
  header("Location:./Login.html");
}

// Admin data
$Admin_ID = $_SESSION['AdminID'];
$Admin_data = "SELECT * FROM admin WHERE Admin_ID='$Admin_ID'";
$Admin_result = mysqli_query($con,$Admin_data);
$Admin_row = mysqli_fetch_assoc($Admin_result);

// $query = "SELECT * FROM orders INNER JOIN cakes ON orders.Cake_id=cakes.Cake_ID WHERE Delivery_Status='Pending';";
$query = "SELECT * FROM  customcakeorders AS orders
INNER JOIN userdetails AS ud ON orders.User_ID=ud.User_ID
INNER JOIN auth ON ud.User_ID=auth.User_ID  WHERE orders.Status != 'Rejected' AND orders.Status='pending' AND Cancel_Status!='cancelled'  ORDER BY  orders.Status DESC 
";

$result = mysqli_query($con, $query);

if (isset($_POST['accept'])) {

  $OrderId = $_GET['OrderId'];
  $price = $_POST['price'];

  $update = mysqli_query($con, "UPDATE customcakeorders SET Price='$price', Status='Accepted' WHERE Custom_Cake_ID='$OrderId'");
  $userDetails = mysqli_query($con,"SELECT * FROM customcakeorders AS co
  INNER JOIN auth ON co.User_ID=auth.User_ID
   WHERE Custom_Cake_ID='$OrderId'");
   $user = mysqli_fetch_assoc($userDetails);
  if ($update) {
    
    
    $Qunatity = $user['Quantity'];
    $Size = $user['Size'];
    $Message = $user['Message'];
    $arrivingDate = $user['Arriving'];
    $price = $user['Price'];

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
          <td>Custom Cake</td>
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
          <th>Price:</th>
          <td>'₹ $price'</td>
        </tr>

       
      <tr>
        <tr class='ar'>
          <th >Arriving on:</th>
          <td><b>'$arrivingDate'</b></td>
        </tr>
      </table>
    </div>
    <p>complete your payment so that your cake can delivered on time</p>
    <h2>Thanks for ordering cake from Craving Crumbs</h2>

  </section>
</body>
</html>

    ";

    $email = $user['Email'];
    $subject="Your Order is Been Accepted";

    sendMail($email,$subject,$body);
    echo "<script> alert('Order Accepted') </script>";
    echo "<script> history.back();</script>";
  } else {
    echo "<script> alert('Failed to Accepted') </script>";
    echo "<script> history.back();</script>";
  }
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Craving Crumbs | Custom Cake Orders</title>

  <!-- css file linked here.. -->
  <link rel="stylesheet" href="../Style/Orders/orders.css" />
  <link rel="stylesheet" href="../Style/CustomOrder/CustomOrder.css" />

  <!-- fav icon -->
  <link rel="icon" href="../../../Icons/cake-white.png" type="image/x-icon" />
</head>

<body>
  <!-- ! Side Navigation bar  -->
  <div class="side-navigation">
    <div class="admin-info">
      <div class="profile-img">
      <p style="text-transform: uppercase;"><?php
          $username = $Admin_row['Username'];
          
          echo substr($username,0,1) ?></p>
      </div>
      <p class="username">Hello! <?php echo $Admin_row['Username'] ?></p>
        <p class="email"><?php echo $Admin_row['Email'] ?></p>
    </div>
    <div class="nav-items">
      <ul>
        <!-- * Dashboard -->
        <li>
          <a href="./Dashboard.php">
            <div class="icon">
              <img src="../Icons/Sys Icon.png" alt="" />
            </div>
            <p>Dashboard</p>
          </a>
        </li>

        <!-- * New Items -->
        <li>
          <a href="./NewItems.php">
            <div class="icon">
              <img src="../Icons/Add Icon.png" alt="" />
            </div>
            <p>New Items</p>
          </a>
        </li>

        <!-- * Table -->
        <li>
          <a href="./Tables.php">
            <div class="icon">
              <img src="../Icons/Databse Icon.png" alt="" />
            </div>
            <p>Table</p>
          </a>
        </li>

        <!-- * Order -->
        <li>
          <a href="./Orders.php">
            <div class="icon">
              <img src="../Icons/Item Icon.png" alt="" />
            </div>
            <p>Orders</p>
          </a>
        </li>

        <!-- * Accept/Reject orders -->
        <li style="background-color: black; opacity: 100%">
          <a href="#">
            <div class="icon">
              <img src="../Icons/Item Icon.png" alt="" />
            </div>
            <p>Accept/Reject Orders</p>
          </a>
        </li>

           <!-- * Custom orders -->
           <li>
          <a href="./CustomOrders.php ">
            <div class="icon">
              <img src="../Icons/Item Icon.png" alt="" />
            </div>
            <p>Custom Orders</p>
          </a>
        </li>

            <!-- * Refund -->
            <li>
          <a href="./Refund.php ">
            <div class="icon">
              <img src="../Icons/refund.png" alt="" />
            </div>
            <p>Refunds</p>
          </a>
        </li>
      </ul>
    </div>
 
  </div>

  <!-- ! Nav bar -->
  <div class="nav-bar">
    <div class="logo"><img src="../Icons/Logo.png" alt="" /></div>
    <a href="../PHP/Logout.php" class="logout">Logout</a>
  </div>


  <div class="overlay"></div>

  <section>
    <p class="link">/Custom Orders</p>
    <div class="orders">


      <?php while ($row = mysqli_fetch_array($result)) {

      ?>

        <div class="order-card">
          <div class="img-container">
            <img src="../../Uploaded-Img/Custom-Cake/<?php echo $row['Cake_Photo'] ?>" alt="">
          </div>


          <div class="info">
            <div class="top">
              <h1><?php echo limitTextChars($row['Cake_Name'], 25, true, true);  ?></h1>
              <!-- <p class="price">₹ <?php echo $row['Price'] *  $row['Quantity'] ?></p> -->
              <p class="Quantity">Size: <?php echo $row['Size'] ?></p>
              <p class="Quantity">Quantity: <?php echo $row['Quantity'] ?></p>
              <p class="address">address: <?php echo $row['Address'] ?></p>


            </div>

            <div class="bottom">


              <?php
              # if the order is not accepted than allow for payment
              if ($row['Status'] != "Accepted") {

              ?>

                <!-- form -->
                <form action="http://localhost/CakeSite/Admin/Pages/Accept-Reject-orders.php?OrderId=<?php echo $row['Custom_Cake_ID'] ?>" method="POST">
                  <input required type="number" placeholder="Price" name="price">
                  <input type="submit" name="accept" value="Accept order">
                </form>

              <?php } ?>

              <!-- BTNS  -->
              <div class="btns">
                <div class="btn view view-btn" data-viewIndex="<?php echo $row['Custom_Cake_ID']; ?>">View</div>

                <?php
                # if the order is not accepted than allow for payment
                if ($row['Status'] != "Accepted") {

                ?>
                  <!-- <a href="../PHP/Reject.php<?php echo $row['Order_ID']; ?>" class="btn delivered-btn reject">Reject</a> -->
             
                  <?php echo "<td><a class='btn delivered-btn reject' href='../PHP/Reject.php?CustOrderID=" . $row['Custom_Cake_ID'] . "' onClick=\"javascript:return confirm('are you sure you want to reject this order?');\">Reject</a></td><tr>";?>
             
                  <?php } ?>
              </div>
            </div>
          </div>
        </div>

        <div class="float-card" data-Floatindex="<?php echo $row['Custom_Cake_ID']; ?>">

          <div class="close-btn" onclick="close1()">
            <div class="line l1"></div>
            <div class="line l2"></div>
          </div>

          <div class="container">
            <div class="info">

              <h2 class="title">Custom Cake</h2>
              <!-- cake info -->
              <div class="content">

                <ul>
                  <h3>Cake Details</h3>
                  <!-- <li class="price"><span>Price :</span> <?php echo '₹ ' . ($row['Price'] * $row['Quantity']) ?></li> -->
                  <li><span>Cake Flavour :</span> <?php echo ($row['Cake_Flavors']) ?></li>

                  <li><span>Type of Cake :</span> <?php echo ($row['Cake_Type']) ?></li>
                  <li><span>Type of Cream :</span> <?php echo ($row['Cream_Type']) ?></li>
                  <li><span>Toppings :</span> <?php echo ($row['Toppings']) ?></li>
                  <li><span>Type of Bread :</span> <?php echo ($row['Bread_Type']) ?></li>

                  




                </ul>

                <ul class="order-details">

                  <h3>Order Details</h3>



                  <li><span>Quantity:</span> <?php echo ($row['Quantity']) ?></li>
                  <li><span>Size:</span> <?php echo ($row['Size']) ?></li>
                  <li><span>Expecting Order on :</span> <?php echo ($row['Arriving']) ?></li>
                </ul>

                <ul>

                  <h3>User Details</h3>


                  <li><span>User:</span> <?php echo ($row['Username']) ?></li>
                  <li><span>Phone:</span> <?php echo ($row['Phone_No']) ?></li>
                  <li><span>City:</span> <?php echo ($row['City']) ?></li>
                  <li><span>Address:</span> <?php echo ($row['Address']) ?></li>
                  <li><span>Pincode:</span> <?php echo ($row['Pincode']) ?></li>
   
                </ul>

              </div>
            </div>
          </div>

        </div>


      <?php } ?>
  </section>
</body>
<!-- <script type="text/javascript" src="http://code.jquery.com/jquery-1.8.2.js"></script> -->



<script src="../JS/floatCard.js"></script>



</html>