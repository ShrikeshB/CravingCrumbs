<?php


// to ignore notices
error_reporting(E_ALL ^ E_NOTICE);

// included the DB connection file
include_once '../PHP/connectDB.php';
include_once('../PHP/Login/LoginChecker.php');
session_start();

# checks whether the user has logged in
hasLoggedIn();

$UserID = $_SESSION['UserID'];

$Order_Query = "SELECT * FROM orders INNER JOIN cakes ON orders.Cake_ID = cakes.Cake_ID WHERE User_ID = $UserID AND Cancel_Status='none' ORDER BY Orders.Order_ID DESC";
$Order_Result = mysqli_query($con, $Order_Query);

$Cust_Query = "SELECT * FROM customcakeorders WHERE User_ID=$UserID AND Cancel_Status='none' ORDER BY Custom_Cake_ID DESC";
$Cust_Result = mysqli_query($con, $Cust_Query);



?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Craving Crumbs | Your Orders</title>

  <!-- fav icon -->
  <link rel="icon" href="../../Icons/cake-white.png" type="image/x-icon" />

  <!-- css file linked -->
  <link rel="stylesheet" href="../Styles/Orders/order.css" />

  <!-- responsive css file linked -->
  <link rel="stylesheet" href="../Styles/Orders/Resp/OrderResp.css" />
</head>

<body>
  <!-- //! ------------- navigation-Bar ---------------------- -->
  <div class="navigation">
    <a href="../index.php" class="logo">
      <div class="img-container">
        <img src="../../Images/Component_Img/Logo.png" alt="" />
      </div>
    </a>

    <!-- search btn & more cake options -->
    <div class="btns-fields">
      <div class="input-container">
        <!-- search-btn -->
        <div class="search-btn">
          <form action="http://localhost/CakeSite/src/Pages/search.php" method="get">
            <input name="searchField" type="search" placeholder="Dark forest cake..." />
            <button type="submit" name="search">
              <img src="../../Icons/Search Icon.png" alt="search icon" />
            </button>
          </form>

        </div>

        <!-- more cake option -->
        <div class="more-cakes">
          <select class="more-cake-options" onchange="Morecakes()" name="">
            <option disabled selected hidden>More Cakes</option>
            <option value="Birthday-Cakes">Birthday cakes</option>
            <option value="Anniversary-Cake">Anniversary cakes</option>
            <option value="Wedding-Cakes">Wedding cakes</option>
            <option value="Premium-Cakes">Premium cakes</option>
            <option value="Best-Seller">Best Seller</option>
          </select>
        </div>

        <!-- Sign up btn -->
        <?php

        if ($_SESSION['isLogin']) {
          echo ' <a href="http://localhost/CakeSite/src/PHP/Logout.php" class="signup-btn logout-btn"> Logout </a>';
        } else {
          echo '   <a href="../Pages/Login.html" class="signup-btn"> sign in </a>';
        }
        ?>
      </div>
    </div>

    <!-- All links for pages -->
    <div class="nav-items">
      <ul>
        <li>
          <a href="../Pages/CustomCake.html">
            <div class="img-container">
              <img src="../../Icons/custom.png" alt="custom cake icon" />
            </div>
            <p>custom cake</p>
          </a>
        </li>
        <li class="order">
          <a href="../Pages/Orders.html">
            <div class="img-container">
              <img src="../../Icons/order.png" alt="custom cake icon" />
            </div>
            <p>orders</p>
            <div class="circle">
              <p>01</p>
            </div>
          </a>
        </li>
        <li class="cart">
          <a href="../Pages/Cart.html">
            <div class="img-container">
              <img src="../../Icons/cart.png" alt="custom cake icon" />
            </div>
            <p>cart</p>

            <div class="circle cart-circle">
              <p>01</p>
            </div>
          </a>
        </li>
        <li class="cart">
          <a href="../Pages/UserAccount.html">
            <div class="img-container">
              <img src="../../Icons/user.png" alt="custom cake icon" />
            </div>
            <p>your account</p>
          </a>
        </li>
      </ul>
    </div>

    <!-- burger-btn -->
    <div class="burger-btn" onclick="onClickBurger()">
      <div class="line line1"></div>
      <div class="line line2"></div>
      <div class="line line3"></div>
    </div>
  </div>

  <!-- side-nav-bar -->
  <div class="side-nav-bar">
    <!-- All links for pages -->
    <div class="nav-items">
      <ul>
        <li>
          <a href="./CustomCake.php">
            <div class="img-container">
              <img src="../../Icons/custom.png" alt="custom cake icon" />
            </div>
            <p>custom cake</p>
          </a>
        </li>
        <li class="order">
          <a href="./Orders.php">
            <div class="img-container">
              <img src="../../Icons/order.png" alt="order cake icon" />
            </div>
            <p>orders</p>
            <div class="circle">
              <p>01</p>
            </div>
          </a>
        </li>
        <li class="cart">
          <a href="./Cart.php">
            <div class="img-container">
              <img src="../../Icons/cart.png" alt="custom cake icon" />
            </div>
            <p>cart</p>

            <div class="circle cart-circle">
              <p>01</p>
            </div>
          </a>
        </li>

        <li class="cart">
          <a href="./UserAccount.php">
            <div class="img-container">
              <img src="../../Icons/user.png" alt="custom cake icon" />
            </div>
            <p>Your Account</p>
          </a>
        </li>
      </ul>
    </div>
  </div>

  <!-- //! ------------- order-section ---------------------- -->
  <section class="order-section">
    <h1 class="heading">Your orders</h1>

    <div class="order-card-container">
      <?php if (mysqli_num_rows($Order_Result) < 1) { ?>
        <p style="text-align: center;">No Order to view</p>

      <?php
      } else
        while ($row = mysqli_fetch_array($Order_Result)) {
      ?>
        <!--* card -->
        <div class="order-card">
          <!--* cake img holder  -->
          <div class="img-container">
            <img src="../../Uploaded-Img/Cakes/<?php echo ($row['Category']) . "/" . ($row['Cake_Img'])   ?>" alt="cake img not found!" />

          </div>

          <div class="content">
            <div class="top">
              <h1><?php echo ($row['Cake_Name']) ?></h1>
              <p class="price">₹ <?php echo ($row['Amt']) ?></p>
              <p class="category"><?php echo ($row['Category']) ?></p>

            </div>

            <div class="bottom">
              <div>
                <p class="arriving"> <?php if ($row['Delivery_Status'] == 'Pending') echo "Arriving on " . ($row['Arriving']);
                                      else echo 'Delivered'; ?></p>
                <a href="http://localhost/CakeSite/src/Pages/OrderDetails.php?orderID=<?php echo ($row['Order_ID']) ?>" class="view-more">view order</a>
              </div>

              <?php

              // compare time for cancellation of order
              date_default_timezone_set("Asia/Calcutta");

              $datetime1 = new DateTime($row['TimeOfOrder']);
              $currentDate = new DateTime(strval(date("Y-m-d H:i:s")));
              $interval = $datetime1->diff($currentDate);
              // echo $interval->format('%h') . " Hours " . $interval->format('%i') . " Minutes";

              // if true show cancel btn
              if (($currentDate->format("%Y-%m-%d") <= $datetime1->format("%Y-%m-%d") && ($interval->format('%i') < 30  && $interval->format('%h') <= 0)) && $row['Delivery_Status'] != 'Delivered') {


              ?>


                <!-- <a href="http://localhost/CakeSite/src/PHP/CancelOrder.php?OrderID=<?php echo ($row['Order_ID']) ?>" class="cancel-btn">cancel order</a> -->

                <?php echo "<td><a class='cancel-btn' href='http://localhost/CakeSite/src/PHP/CancelOrder.php?OrderID=" . $row['Order_ID'] . "' onClick=\"javascript:return confirm('are you sure you want to cancel this order?');\">cancel order</a></td><tr>";
                ?>


              <?php } ?>
            </div>

          </div>
        </div>

      <?php
        }
      ?>
    </div>
  </section>
  <hr>
  <!-- //! ------------- custom-order-section ---------------------- -->
  <section class="custom-order-section">
    <p class="heading" style="margin-bottom: 1em;">Custom cake order</p>

    <?php if (mysqli_num_rows($Cust_Result) < 1) { ?>
      <p style="text-align: center;">No Custom Order to view</p>

      <!-- card-holder -->
      <div class="cust-card-container">



      <?php
    } else
      while ($row = mysqli_fetch_array($Cust_Result)) {
      ?>

        <!--* card -->
        <div class="order-card">
          <!--* cake img holder  -->
          <div class="img-container">
            <img src="../../Uploaded-Img/Custom-Cake/<?php echo ($row['Cake_Photo']) ?>" alt="cake img not found!" />

          </div>

          <div class="content cust-content">

            <div class="bottom">
              <div class="info">

                <p class="arriving"><b>Status:</b> <?php echo ($row['Status']) ?></p>
                <p class="arriving"><b>Payment: </b> <?php echo ($row['Payment_Status']) ?></p>
                <p class="arriving"><b>Expecting on: </b> <?php echo ($row['Arriving']) ?></p>
                <p class="arriving"><b>Delivery Status: </b> <?php echo ($row['Delivery_Status']) ?></p>


                <a href="http://localhost/CakeSite/src/Pages/OrderDetails.php?custOrderID=<?php echo ($row['Custom_Cake_ID']) ?>" class="view-more">view order</a>
              </div>
              <?php

              // compare time for cancellation of order
              date_default_timezone_set("Asia/Calcutta");
              $datetime1 = new DateTime($row['TimeOfOrder']);
              $currentDate = new DateTime(strval(date("Y-m-d H:i:s")));
              $interval = $datetime1->diff($currentDate);
              //  echo $interval->format('%h') . " Hours " . $interval->format('%i') . " Minutes";



              ?>

              <div class="links">
                <?php
                if ($row['Status'] == "Accepted" && $row['Payment_Status'] != "completed" && $row['Delivery_Status'] != "Delivered") {
                ?>
                  <a style="margin-bottom: 1em;" href="http://localhost/CakeSite/src/Pages/CustomPayment.php?CustID=<?php echo ($row['Custom_Cake_ID']); ?>" class="cancel-btn">Pay now</a>
                  <?php echo "<td><a style='background-color: #d5d5d5; color: black;' class='cancel-btn' href='http://localhost/CakeSite/src/PHP/CancelOrder.php?CustOrderID=" . $row['Custom_Cake_ID'] . "' onClick=\"javascript:return confirm('are you sure you want to cancel this order?');\">cancel order</a></td><tr>"; ?>

                  <!-- <a style="background-color: #d5d5d5; color: black;" href="http://localhost/CakeSite/src/PHP/CancelOrder.php?OrderID=<?php echo ($row['Order_ID']); ?>" class="cancel-btn">cancel order</a> -->
                <?php } else { ?>
                  <br>
                  <?php if (($currentDate->format("%Y-%m-%d") <= $datetime1->format("%Y-%m-%d") && ($interval->format('%i') < 30  && $interval->format('%h') <= 0)) && $row['Delivery_Status'] != 'Delivered') {
                  ?>

                    <?php echo "<td><a class='cancel-btn' href='http://localhost/CakeSite/src/PHP/CancelOrder.php?CustOrderID=" . $row['Custom_Cake_ID'] . "' onClick=\"javascript:return confirm('are you sure you want to cancel this order?');\">cancel order</a></td><tr>"; ?>

                    <!-- <a href="http://localhost/CakeSite/src/PHP/CancelOrder.php?OrderID=<?php echo ($row['Order_ID']); ?>" class="cancel-btn">cancel order</a> -->
                <?php }
                } ?>

              </div>

            </div>

          </div>
        </div>




      <?php
      }
      ?>

      </div>
  </section>

  <!-- //! ----------------- Footer ------------ -->
  <footer>
    <div class="container">
      <a href="../index.php" class="logo">
        <div class="img-container">
          <img src="../../Images/Component_Img/Logo.png" alt="" />
        </div>
      </a>
      <div class="content">
        <!-- know us -->
        <div>
          <h1>know us</h1>
          <ul>
            <li><a href="../Pages/About.php">About Us</a></li>
            <li><a href="../Pages/Contact.php">Contact us</a></li>
          </ul>
        </div>

        <!-- more links -->
        <div>
          <h1>links</h1>
          <ul>
            <li><a href="./Orders.php">Orders</a></li>
            <li><a href="./CustomCake.php">Custom Cakes</a></li>
            <li><a href="./Cart.php">Cart</a></li>
            <li><a href="./UserAccount.php">User details</a></li>
            <li><a href="./Contact.php">Contact us</a></li>
            <li><a href="./About.php">About us</a></li>
          </ul>
        </div>

        <!-- Find us -->
        <div class="find-us">
          <div class="social-media">
            <h1>Find us</h1>
            <a href="https://instagram.com/_craving_crumbs_?igshid=YmMyMTA2M2Y=" class="insta-icon">
              <img src="../../Icons/instagram.png" alt="Insta Icon" />
              <p>Instagram</p>
            </a>
          </div>
        </div>
      </div>
    </div>
  </footer>
</body>
<script src="../JS/Nav-Bar/NavBar.js"></script>
<!-- more cake navigation -->
<script src="../JS/MoreCake/MoreCake.js"></script>

</html>