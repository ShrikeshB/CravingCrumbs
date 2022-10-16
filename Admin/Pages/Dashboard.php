<?php
#Admin Dashboard here all the site data is available...


// to ignore notices
error_reporting(E_ALL ^ E_NOTICE);
session_start();
// included the DB connection file
include_once '../../src/PHP/connectDB.php';

if (!$_SESSION['IsAdminLogged']) {
  header("Location:./Login.html");
}

// Admin data
$Admin_ID = $_SESSION['AdminID'];
$Admin_data = "SELECT * FROM admin WHERE Admin_ID='$Admin_ID'";
$Admin_result = mysqli_query($con, $Admin_data);
$Admin_row = mysqli_fetch_assoc($Admin_result);



# total cakes available
$TotalCake_query = "SELECT * FROM cakes";
$TotalCake_result = mysqli_query($con, $TotalCake_query);
$TotalCake_count = mysqli_num_rows($TotalCake_result);

# total users available
$user_query = "SELECT * FROM auth";
$user_result = mysqli_query($con, $user_query);
$users_count = mysqli_num_rows($user_result);


# total reviews available
$review_query = "SELECT * FROM review";
$review_result = mysqli_query($con, $review_query);
$review_count = mysqli_num_rows($review_result);

# total refunds available
$refund_query = "SELECT * FROM refund WHERE Status='pending'";
$refund_result = mysqli_query($con, $refund_query);
$refund_count = mysqli_num_rows($refund_result);


# count of orders
$order_query = "SELECT * FROM orders where Cancel_Status != 'cancelled' AND Delivery_Status = 'Pending'";
$order_result = mysqli_query($con, $order_query);
$order_count = mysqli_num_rows($order_result);

# count of order delivered
$delivery_query = "SELECT * FROM orders where Cancel_Status != 'cancelled' AND Delivery_Status = 'Delivered'";
$delivery_result = mysqli_query($con, $delivery_query);
$delivery_count = mysqli_num_rows($delivery_result);

# count of custom cake orders
$cust_Order_query = "SELECT * FROM customcakeorders where Cancel_Status != 'cancelled' AND Delivery_Status = 'Pending' AND Payment_Status = 'completed'";
$cust_Order_result = mysqli_query($con, $cust_Order_query);
$cust_Order_count = mysqli_num_rows($cust_Order_result);

# count of cancelled orders
$cancel_query = "SELECT * FROM orders where Cancel_Status = 'cancelled' AND Delivery_Status = 'Pending'";
$cancel_result = mysqli_query($con, $cancel_query);
$cancel_count = mysqli_num_rows($cancel_result);

# count of cancelled orders
$cust_cancel_query = "SELECT * FROM customcakeorders where Cancel_Status = 'cancelled' AND Delivery_Status = 'Pending'";
$cust_cancel_result = mysqli_query($con, $cust_cancel_query);
$cust_cancel_count = mysqli_num_rows($cust_cancel_result);





//! -------------------  CAKES COUNTS ----------------

# wedding_count
$Wedding_query = "SELECT * FROM cakes WHERE Category = 'Wedding-Cakes'";
$weddinng_result = mysqli_query($con, $Wedding_query);
$wedding_count = mysqli_num_rows($weddinng_result);

# Birthday_count
$Birthday_query = "SELECT * FROM cakes WHERE Category = 'Birthday-Cakes'";
$Birthday_result = mysqli_query($con, $Birthday_query);
$Birthday_count = mysqli_num_rows($Birthday_result);

# Anniversary_count
$Anniversary_query = "SELECT * FROM cakes WHERE Category = 'Anniversary-Cake'";
$Anniversary_result = mysqli_query($con, $Anniversary_query);
$Anniversary_count = mysqli_num_rows($Anniversary_result);

# Best-seller count
$Best_query = "SELECT * FROM cakes WHERE Category = 'Best-Seller'";
$Best_result = mysqli_query($con, $Best_query);
$Best_count = mysqli_num_rows($Best_result);

# Premium_count
$Premium_query = "SELECT * FROM cakes WHERE Category = 'Premium-Cakes'";
$Premium_result = mysqli_query($con, $Premium_query);
$Premium_count = mysqli_num_rows($Premium_result);


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Craving Crumbs | Dashboard</title>

  <!-- css file linked here.. -->
  <link rel="stylesheet" href="../Style/Dashboard/AdminStyle.css" />

  <!-- fav icon -->
  <link rel="icon" href="../../../Icons/cake-white.png" type="image/x-icon" />
</head>

<body>
  <!--// ! Side Navigation bar  -->
  <div class="side-navigation">
    <div class="admin-info">
      <div class="profile-img">
        <p style="text-transform: uppercase;"><?php
                                              $username = $Admin_row['Username'];

                                              echo substr($username, 0, 1) ?></p>
      </div>

      <p class="username">Hello! <?php echo $Admin_row['Username'] ?></p>
      <p class="email"><?php echo $Admin_row['Email'] ?></p>
    </div>
    <div class="nav-items">
      <ul>
        <!-- * Dashboard -->
        <li style="background-color: black; opacity: 100%">
          <a href="#">
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

  <!-- //! Nav bar -->
  <div class="nav-bar">
    <div class="logo"><img src="../Icons/Logo.png" alt="" /></div>
    <a href="../PHP/Logout.php" class="logout">Logout</a>
  </div>

  <!-- ! Dashboard Section -->
  <section>
    <p class="link">/Dashboard</p>


    <!-- //!-------- TOTAL DATA-------->

    <div class="total-container">
      <!-- total cake card -->
      <div class="total-card">
        <div class="img-container">
          <img src="../Icons/cake.png" alt="" />
        </div>

        <div class="content">
          <h2><?php echo $TotalCake_count; ?></h2>
          <p>Total cakes</p>
        </div>
      </div>

      <div class="total-card">
        <div class="img-container">
          <img src="../Icons/User Icon.png" alt="" />
        </div>

        <div class="content">
          <h2><?php echo $users_count; ?></h2>
          <p>Total users</p>
        </div>
      </div>


    </div>

    <br><br>

    <!-- //!-------- CAKE DATA-------->

    <!-- card-grid -->
    <p class="heading">Cake data</p>
    <div class="container">

      <!-- card -->
      <div class="card birthday">
        <div class="img-container">
          <img src="../Icons/Birthday cake.png" alt="" />
        </div>

        <div class="content">
          <h2><?php echo $Birthday_count; ?></h2>
          <p>Birthday cakes</p>
        </div>
      </div>

      <!-- card -->
      <div class="card premium">
        <div class="img-container">
          <img src="../Icons/cake.png" alt="" />
        </div>

        <div class="content">
          <h2><?php echo $Premium_count; ?></h2>
          <p>premium cakes</p>
        </div>
      </div>

      <!-- card -->
      <div class="card wedding">
        <div class="img-container">
          <img src="../Icons/wedding-cake.png" alt="" />
        </div>

        <div class="content">
          <h2><?php echo $wedding_count; ?></h2>
          <p>Wedding cakes</p>
        </div>
      </div>

      <!-- card -->
      <div class="card anniversary">
        <div class="img-container">
          <img src="../Icons/cake.png" alt="" />
        </div>

        <div class="content">
          <h2><?php echo $Anniversary_count; ?></h2>
          <p>Anniversary cakes</p>
        </div>

      </div>

      <!-- card -->
      <div class="card birthday">
        <div class="img-container">
          <img src="../Icons/Birthday cake.png" alt="" />
        </div>

        <div class="content">
          <h2><?php echo $Best_count; ?></h2>
          <p>Best Seller cakes</p>
        </div>
      </div>

    </div>


    <!-- //!-------- ORDERS DATA-------->
    <!-- card-grid -->
    <p class="heading">Orders data</p>
    <div class="container">

      <!-- Orders -->
      <div class="card birthday">
        <div class="img-container">
          <img src="../Icons/order-delivery.png" alt="" />
        </div>

        <div class="content">
          <h2><?php echo $order_count; ?></h2>
          <p>Orders</p>
        </div>
      </div>

      <!-- Custom cakes orders -->
      <div class="card anniversary">
        <div class="img-container">
          <img src="../Icons/box.png" alt="" />
        </div>

        <div class="content">
          <h2><?php echo $cust_Order_count; ?></h2>
          <p>Custom cakes orders</p>
        </div>

      </div>

      <!-- cancelled orders -->
      <div class="card premium">
        <div class="img-container">
          <img src="../Icons/cancel.png" alt="" />
        </div>

        <div class="content">
          <h2><?php echo $cancel_count; ?></h2>
          <p>cancelled orders</p>
        </div>
      </div>

      <!-- cancelled orders -->
      <div class="card premium">
        <div class="img-container">
          <img src="../Icons/cancel.png" alt="" />
        </div>

        <div class="content">
          <h2><?php echo $cust_cancel_count; ?></h2>
          <p>cancelled custom </p>
          <p> orders</p>
        </div>
      </div>

      <!-- Cakes Delivered -->
      <div class="card wedding">
        <div class="img-container">
          <img src="../Icons/sent.png" alt="" />
        </div>

        <div class="content">
          <h2><?php echo $delivery_count; ?></h2>
          <p>Cakes Delivered</p>
        </div>
      </div>




    </div>


    <!-- //!-------- Other DATA-------->
    <!-- card-grid -->
    <p class="heading">Other data</p>
    <div class="container">

      <!-- Refund -->
      <div class="card birthday">
        <div class="img-container">
          <img src="../Icons/refund black.png" alt="" />
        </div>

        <div class="content">
          <h2><?php echo $refund_count; ?></h2>
          <p>Refund</p>
        </div>
      </div>

      <!-- cakes Reviews -->
      <div class="card anniversary">
        <div class="img-container">
          <img src="../Icons/reviews.png" alt="" />
        </div>

        <div class="content">
          <h2><?php echo $review_count; ?></h2>
          <p>cakes Reviews</p>
        </div>

      </div>



    </div>


  </section>
</body>

</html>