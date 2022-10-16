<?php
include_once('../PHP/Login/LoginChecker.php');

// included the DB connection file
include_once '../PHP/connectDB.php';

// to ignore notices
error_reporting(E_ALL ^ E_NOTICE);
session_start();

# checks whether the user has logged in
hasLoggedIn();

$OrderID = $_GET['orderID'];
$CustOrderID = $_GET['custOrderID'];
$UserID = $_SESSION['UserID'];
// Query to fetch the data as per the CaKe Id

$IsCustCake = false;
if ($OrderID != null) {
  $Cake_Details_Query = "SELECT * FROM orders INNER JOIN cakes ON orders.Cake_id=cakes.Cake_ID  WHERE orders.Order_ID='$OrderID' AND orders.User_ID='$UserID'";
  $result_Of_Cakes_Details = mysqli_query($con, $Cake_Details_Query);
  $result_Of_Cakes_Details1 = mysqli_query($con, $Cake_Details_Query);
  $cake_Order_Row = mysqli_fetch_assoc($result_Of_Cakes_Details1);
} else if ($CustOrderID != null) {
  $IsCustCake = true;
  $Cake_Details_Query = "SELECT * FROM customcakeorders WHERE Custom_Cake_ID='$CustOrderID'";
  $result_Of_Cakes_Details = mysqli_query($con, $Cake_Details_Query);
}

if (isset($_POST['save'])) {
  echo $_POST['ratedIndex'] + 1;
}

if (!$IsCustCake) {
  # check if user has submitted the review or not..
  $CakeId = $cake_Order_Row['Cake_ID'];
  $review_fetch_query = "SELECT * FROM review WHERE User_ID = $UserID AND Cake_ID = $CakeId";
  $fetch_result = mysqli_query($con, $review_fetch_query);
  $review_row = mysqli_fetch_assoc($fetch_result);
}


# uploading the review of user...
# Used to submit the review if not submitted.
if (isset($_POST['reviewBtn'])) {
  // fetching the rating from cookie that is save in js and then cookie.
  if ($_COOKIE['rating']) {
    $rating = $_COOKIE['rating'];
    $rating = $rating + 1; // in js rating index start from 0 so to get proper rating incrementing is used.
    // after fetching the cookie data set the cookie rating value to zero
    setcookie("rating", "0", time() + (10 * 365 * 24 * 60 * 60));
  } else {
    $rating = 0;
  }


  $Cake_Details_Query1 = "SELECT * FROM orders WHERE Order_ID='$OrderID' AND User_ID='$UserID'";
  $result_Of_Cakes_Details1 = mysqli_query($con, $Cake_Details_Query1);
  $cake_Order_Row = mysqli_fetch_assoc($result_Of_Cakes_Details1);

  $review = $_POST['review'];
  $CakeID = $cake_Order_Row['Cake_id'];



  $review_query = "INSERT INTO review VALUES('', '$UserID', '$CakeID','$OrderID','$review','$rating')";
  $Result_review = mysqli_query($con, $review_query);
  if ($Result_review)
    echo "<script> alert('Review submited!'); history.back(); </script>";
    
  else{
    echo "<script> alert('Review failed to submit!'); history.back(); </script>";
    echo mysqli_error($con);
  }
 
} else
  # used to re-submit the review... 
  if (isset($_POST['re-submit-review'])) {
    $review = $_POST['review'];
    $CakeID = $cake_Order_Row['Cake_ID'];
    if ($_COOKIE['rating']) {
      $rating = $_COOKIE['rating'];
      $rating = $rating + 1; // in js rating index start from 0 so to get proper rating incrementing is used.
      // after fetching the cookie data set the cookie rating value to zero
      setcookie("rating", "0", time() + (10 * 365 * 24 * 60 * 60));
    } else {
      $rating = 0;
    }
    $review_query = "UPDATE review SET Review='$review', Rating='$rating' WHERE User_ID='$UserID' AND Cake_ID='$CakeID'";
    $Result_review = mysqli_query($con, $review_query);
    if ($Result_review) {
      echo "<script> alert('Review re-submited!') </script>";
      echo "<script> history.back() </script>";
    } else
      echo "<script> alert('Review failed to re-submit!'); history.back()  </>";
  }


?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Craving Crumb | Order Details</title>
  <!-- css file linked -->
  <link rel="stylesheet" href="../Styles/Details/Details.css" />
  <!-- order details css linked -->
  <link rel="stylesheet" href="../Styles/OrderDetails/OrderDetails.css" />
  <!-- responsive file linked -->
  <link rel="stylesheet" href="../Styles/Details/Resp/DetailResp.css" />
  <!-- fav icon -->
  <link rel="icon" href="../../Icons/cake-white.png" type="image/x-icon" />
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
          <a href="../Pages/CustomCake.php">
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
          <a href="../Pages/UserAccount.php">
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

  <!-- //! ------------- cake-information-section ---------------------- -->
  <section class="cake-info-section">
    <div class="container">

      <?php
      while ($row = mysqli_fetch_array($result_Of_Cakes_Details)) {

        // while will be fetching data here...

        // used to get the cakes in suggestion section 
        $cakeCategory = $row['Category'];
      ?>

        <!-- cake img -->
        <div class="cake-img">
          <?php
          if (!$IsCustCake) {


          ?>

            <img src="../../Uploaded-Img/Cakes/<?php echo ($row['Category']) . "/" . ($row['Cake_Img'])   ?>" alt="cake image" />
          <?php } else { ?>
            <img src="../../Uploaded-Img/Custom-Cake/<?php echo ($row['Cake_Photo'])   ?>" alt="cake image" />

          <?php } ?>
        </div>

        <!-- cake desc -->
        <div class="content">
          <!-- cake info -->
          <div class="info">
            <h1 class="title"><?php
                              if (!$IsCustCake) {
                                echo ($row['Cake_Name']);
                              } else echo "Custom cake" ?></h1>



            <h1 class="price">₹ <?php
            if (!$IsCustCake){
                                if ($row['Size'] == '500gram')
                                  echo  $row['Quantity'] * $row['Price'];
                                else if ($row['Size'] == '1kg')
                                  echo $row['Quantity'] * $row['PriceOf1'];
                                else if ($row['Size'] == '1.5kg')
                                  echo $row['Quantity'] * $row['PriceOf1_5'];
                                else if ($row['Size'] == '2kg')
                                  echo $row['Quantity'] * $row['PriceOf2'];
            }else{
              echo $row['Quantity'] * $row['Price'];
            }
                                ?></h1>
            <p><?php echo ($row['Category']) ?></p>
            <ul>
              <li><span>Cake Flavour :</span> <?php echo ($row['Cake_Flavors']) ?></li>
              <li><span>Type of Cake :</span> <?php echo ($row['Cake_Type']) ?></li>
              <li><span>Type of Cream :</span> <?php echo ($row['Cream_Type']) ?></li>
              <li><span>Toppings :</span> <?php echo ($row['Toppings']) ?></li>
              <li><span>Type of Bread :</span> <?php echo ($row['Bread_Type']) ?></li>
              <li><span>Quantity :</span> <?php echo ($row['Quantity']) ?></li>
              <li><span>Size :</span> <?php echo ($row['Size']) ?></li>
              <li><span>Message :</span> <?php echo ($row['Message']) ?></li>
              <li> <span>Arriving on :</span><b> <?php echo ($row['Arriving'])  ?></b> </li>

              <?php
              if ($IsCustCake) {
              ?>
                <li> <span>Order Status :</span><b> <?php echo ($row['Status'])  ?></b></li>
                <li> <span>Payment Status :</span><b> <?php echo ($row['Payment_Status'])  ?></b></li>


              <?php } ?>
            </ul>
          </div>
        <?php } ?>








        </div>
  </section>


  <!-- //! ------------- Review-section ---------------------- -->
  <?php if ($cake_Order_Row['Delivery_Status'] == 'Delivered' && $IsCustCake == false) { ?>
    <section class="review">

      <?php if ($review_row != null) {
        $rates = $review_row['Rating'];
      ?>
      <hr>
       <p class="heading" style="margin-top: 1em;">Your Review</p>
        <p><?php echo $review_row['Review'] ?></p>
        <div class="stars-grp">
          <?php
          $rates_stars = 5;
          for ($i = 0; $i < $rates; $i++) {
            $rates_stars = $rates_stars - 1;

            echo " <div class='rated'></div>";
          }

          for ($i = 0; $i < $rates_stars; $i++) {


            echo " <div class='unrated'></div>";
          }
          ?>

        </div>
      <?php } ?>

      <p class="heading" style="margin-top: 1em;">
      
      <?php if ($review_row != null) echo 'update your review';
                                      else echo 'Write Your Review' ?></p>

      <div class="container">
        <form action="http://localhost/CakeSite/src/Pages/OrderDetails.php?orderID=<?php echo $OrderID ?>" method="post">
          <textarea required name="review" id="" cols="100" rows="10"></textarea>

          <br>
          <p class="heading">Rating</p>
          <div class="stars-grp">
            <div class="star rated" data-index="0"></div>
            <div class="star" data-index="1"></div>
            <div class="star" data-index="2"></div>
            <div class="star" data-index="3"></div>
            <div class="star" data-index="4"></div>
          </div>

          <input type="submit" name="<?php if ($review_row != null) echo 're-submit-review';
                                      else echo 'reviewBtn' ?>" value="<?php if ($review_row != null) echo 're-submit';
                                                                      else echo 'submit' ?>">
        </form>
      </div>
    </section>

  <?php } ?>

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




<script type="text/javascript" src="http://code.jquery.com/jquery-1.8.2.js"></script>
<script src="../JS/Nav-Bar/NavBar.js"></script>
<!-- more cake navigation -->
<script src="../JS/MoreCake/MoreCake.js"></script>
<script src="../JS/rating/stars.js"></script>
<!-- more cake navigation -->
<script src="../JS/MoreCake/MoreCake.js"></script>

</html>