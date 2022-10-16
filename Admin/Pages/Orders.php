<?php
// to ignore notices
error_reporting(E_ALL ^ E_NOTICE);

// included the DB connection file
include_once '../../src/PHP/connectDB.php';
include_once '../../src/PHP/CharLimits/CharLimits.php';

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
$query = "SELECT * FROM  orders
INNER JOIN cakes ON orders.Cake_id=cakes.Cake_ID 
INNER JOIN userdetails ON userdetails.User_ID=orders.User_ID 
INNER JOIN auth ON userdetails.User_ID=auth.User_ID
WHERE Delivery_Status='Pending' AND Cancel_Status!='cancelled' ;";

$result = mysqli_query($con, $query);





?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Craving Crumbs | Orders</title>

  <!-- css file linked here.. -->
  <link rel="stylesheet" href="../Style/Orders/orders.css" />

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
        <li style="background-color: black; opacity: 100%">
          <a href="#">
            <div class="icon">
              <img src="../Icons/Item Icon.png" alt="" />
            </div>
            <p>Orders</p>
          </a>
        </li>

        <!-- * Accept/Reject orders -->
        <li>
          <a href="./Accept-Reject-orders.php">
            <div class="icon">
              <img src="../Icons/Item Icon.png" alt="" />
            </div>
            <p>Accept/Reject Orders</p>
          </a>
        </li>

        <!-- * Custom orders -->
        <li>
          <a href="./CustomOrders.php">
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
    <p class="link">/Orders</p>
    <div class="orders">


      <?php while ($row = mysqli_fetch_array($result)) {
        // $uid = $row['User_ID'];
        // $user_query = "SELECT * FROM userdetails WHERE User_ID='$uid'";
        // $user_result = mysqli_query($con, $user_query);
        // $user = mysqli_fetch_assoc($user_result);
      ?>

        <div class="order-card">
          <div class="img-container">
            <img src="../../Uploaded-Img/Cakes/<?php echo $row['Category'] . '/' . $row['Cake_Img'] ?>" alt="">
          </div>


          <div class="info">
            <div class="top">
              <h1><?php echo limitTextChars($row['Cake_Name'], 25, true, true);  ?></h1>
              <p class="price">₹ <?php echo $row['Price'] *  $row['Quantity'] ?></p>
              <p class="Quantity">Size: <?php echo $row['Size'] ?></p>
              <p class="Quantity">Quantity: <?php echo $row['Quantity'] ?></p>
              <p class="address">address: <?php echo $row['Address'] ?></p>


            </div>

            <div class="bottom">
              <div class="btn view view-btn" data-viewIndex="<?php echo $row['Order_ID']; ?>">View</div>
              <?php echo "<td><a class='btn delivered-btn' href='../PHP/Delivered.php?orderID=" . $row['Order_ID'] . "' onClick=\"javascript:return confirm('are you sure it\\'s delivered?');\">Delivered</a></td><tr>";
              ?>

              <!-- <a href="../PHP/Delivered.php?orderID=<?php echo $row['Order_ID']; ?>" class="btn delivered-btn">Delivered</a> -->
            </div>
          </div>
        </div>

        <div class="float-card" data-Floatindex="<?php echo $row['Order_ID']; ?>">

          <div class="close-btn" onclick="close1()">
            <div class="line l1"></div>
            <div class="line l2"></div>
          </div>

          <div class="container">
            <div class="info">

              <h2 class="title"><?php echo $row['Cake_Name']  ?></h2>
              <!-- cake info -->
              <div class="content">

                <ul>
                  <h3>Cake Details</h3>
                  <li class="price"><span>Price :</span> <?php echo '₹ ' . ($row['Price'] * $row['Quantity']) ?></li>
                  <li><span>Cake Flavour :</span> <?php echo ($row['Cake_Flavors']) ?></li>

                  <li><span>Type of Cake :</span> <?php echo ($row['Cake_Type']) ?></li>
                  <li><span>Type of Cream :</span> <?php echo ($row['Cream_Type']) ?></li>
                  <li><span>Toppings :</span> <?php echo ($row['Toppings']) ?></li>
                  <li><span>Type of Bread :</span> <?php echo ($row['Bread_Type']) ?></li>

                  <li><span>Category :</span> <?php echo ($row['Category']) ?></li>
                  <li><span>Delivery Time :</span> <?php if ($row['Order_Time'] == 1)
                                                      echo $row['Order_Time'] . ' day';
                                                    else
                                                      echo $row['Order_Time'] . ' days'; ?></li>




                </ul>

                <ul  class="order-details">

                  <h3>Order Details</h3>



                  <li><span>Quantity:</span> <?php echo ($row['Quantity']) ?></li>
                  <li><span>Size:</span> <?php echo ($row['Size']) ?></li>
                  <li><span>Arriving Time :</span> <?php echo ($row['Arriving']) ?></li>
                </ul>

                <ul >

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