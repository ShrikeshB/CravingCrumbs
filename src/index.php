<?php
// to ignore notices
error_reporting(E_ALL ^ E_NOTICE);

// included the DB connection file
include_once './PHP/connectDB.php';
include_once './PHP/CharLimits/CharLimits.php';
session_start();

$cookie_name = "user";
$cookie_value = $_SESSION['UserID']; // user
$LogoutStatus = false;
$UserID = $_SESSION['UserID'];
if ($_SESSION['isLogin']) {

  // if the cookie is not existing then create cookie
  if (!$_COOKIE[$cookie_name]) {
    echo "<script> console.log('new cookie generated'); </script>";

    setcookie($cookie_name, $cookie_value, time() + (10 * 365 * 24 * 60 * 60));
  }
  echo "<script> console.log('login through new password') </script>";
  $LogoutStatus = $_SESSION['isLogin'];
}



// it check whether the user is coming via login or signin process
if ($_SESSION['Form'] && $_SESSION['UserID']) {

  // to check its from sign in form
  if ($_SESSION['UserID'] &&  $_SESSION['Form'] == "signed") {
    // create cookie
    setcookie($cookie_name, $cookie_value, time() + (10 * 365 * 24 * 60 * 60));
    echo "<script> console.log('through Sign in') </script>";
    $LogoutStatus = true;
    $_SESSION['isLogin'] = true;
  }
  // to check its from login form
  else if ($_SESSION['Form'] == "Login" && $_SESSION['UserID']) {
    // create cookie if not exist
    if (!$_COOKIE[$cookie_name]) {
      echo "<script> console.log('existing user login'); </script>";

      setcookie($cookie_name, $cookie_value, time() + (10 * 365 * 24 * 60 * 60));
    } else if ($_COOKIE[$cookie_name] != $_SESSION['UserID']) {
      /*
         * if new user login on same system then new user cookie is generated to avoid 
         * confusion between new user and previous user login info i cookie. 
      */
      echo "<script> console.log('new user login'); </script>";
      setcookie($cookie_name, $cookie_value, time() + (10 * 365 * 24 * 60 * 60));
    }

    $id = $_COOKIE[$cookie_name];
    $id2 = $_SESSION['UserID'];
    echo "<script> console.log('user id cookie = '+'$id') </script>";
    echo "<script> console.log('user id  = '+'$id2') </script>";
    $LogoutStatus = true;
    echo "<script> console.log('through Login') </script>";
    $_SESSION['isLogin'] = true;
  }

  $_SESSION['Cookie_UserID'] = $_COOKIE[$cookie_name];
}
// simply it check whether the user has logged out or not if not then it keeps user logged in.
else if (isset($_COOKIE[$cookie_name])) {

  // fetch cookie data here..
  $_SESSION['UserID'] = $id = $_COOKIE[$cookie_name];

  echo "<script> console.log('user id cookie = '+'$id') </script>";
  $Auth_Query = "SELECT * FROM auth WHERE User_ID = '$id'";
  $result_Of_Auth = mysqli_query($con, $Auth_Query);
  $row = mysqli_fetch_assoc($result_Of_Auth);

  if ($row['Logout_Status'] >= 1 && $row['User_ID'] == $id) {
    echo "<script> console.log('loged in') </script>";
    $LogoutStatus = true;
    $_SESSION['Cookie_UserID'] = $_COOKIE[$cookie_name];
    $_SESSION['isLogin'] = true;
  } else {
    echo "<script> console.log('loged out') </script>";
    $_SESSION['isLogin'] = false;
  }
}


//query to select the data fom best seller cakes
$bestSellerQuery = "SELECT * FROM cakes WHERE category='Best-Seller' ORDER BY Cake_ID DESC LIMIT 6";
$result_Of_BestSeller = mysqli_query($con, $bestSellerQuery);

//query to select the data fom wedding cakes
$WeddingCakeQuery = "SELECT * FROM cakes WHERE category='Wedding-Cakes' ORDER BY Cake_ID DESC LIMIT 3";
$result_Of_WeddingCakes = mysqli_query($con, $WeddingCakeQuery);


//query to select the data fom premium cakes
$PremiumCakeQuery = "SELECT * FROM cakes WHERE category='Premium-Cakes' ORDER BY Cake_ID DESC LIMIT 6";
$result_Of_PremiumCakes = mysqli_query($con, $PremiumCakeQuery);

//query to select the data fom Birthday cakes
$BirthdayCakeQuery = "SELECT * FROM cakes WHERE category='Birthday-Cakes' ORDER BY Cake_ID DESC LIMIT 3 ";
$result_Of_BirthdayCakes = mysqli_query($con, $BirthdayCakeQuery);


//query to select the data fom Anniversary cakes
$AnniversaryCakeQuery = "SELECT * FROM cakes WHERE category='Anniversary-Cake' ORDER BY Cake_ID DESC LIMIT 6";
$result_Of_AnniversaryCakes = mysqli_query($con, $AnniversaryCakeQuery);


$Refund_result = mysqli_query($con, "SELECT * FROM refund WHERE User_ID='$UserID' AND Status='pending'");
$refund = mysqli_fetch_assoc($Refund_result);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Craving Crumb | Home</title>

  <!-- Css Main File Linked -->
  <link rel="stylesheet" href="./Styles/Home/main.css" />
  <!-- Css nav-bar file Linked -->
  <link rel="stylesheet" href="./Styles/Navbar/Navbar.css" />
  <!-- responsive file linked -->
  <link rel="stylesheet" href="./Styles/Home/Resp/mainResp.css">
  <link rel="icon" href="../Icons/cake-white.png" type="image/x-icon" />


  <!-- fav icon -->
  <link rel="icon" href="../../Icons/cake-white.png" type="image/x-icon" />
</head>

<body>


  <?php
  if ($refund != null) {

  ?>
    <!-- notice of refund -->
    <div class="notice">
      <div class="content">
        <p>You can Request for refund</p>
        <a href="./Pages/Refund.php">Refund Now</a>
      </div>
      <div class="close">
        <div class="line l1"></div>
        <div class="line l2"></div>
      </div>
    </div>


  <?php } ?>

  <!-- //! ------------- navigation-Bar ---------------------- -->
  <div class="navigation">
    <a href="#" class="logo">
      <div class="img-container">
        <img src="../Images/Component_Img/Logo.png" alt="" />
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
              <img src="../Icons/Search Icon.png" alt="search icon" />
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

        <!-- _Sign up btn -->

        <?php
        //
        if ($LogoutStatus) {
          echo ' <a href="http://localhost/CakeSite/src/PHP/Logout.php" class="signup-btn logout-btn"> Logout </a>';
        } else {
          echo '   <a href="./Pages/Login.html" class="signup-btn"> sign in </a>';
        }
        ?>




      </div>
    </div>

    <!-- All links for pages -->
    <div class="nav-items">
      <ul>
        <li>
          <a href="./Pages/CustomCake.php">
            <div class="img-container">
              <img src="../Icons/custom.png" alt="custom cake icon" />
            </div>
            <p>custom cake</p>
          </a>
        </li>
        <li class="order">
          <a href="./Pages/Orders.php">
            <div class="img-container">
              <img src="../Icons/order.png" alt="custom cake icon" />
            </div>
            <p>orders</p>
            <div class="circle">
              <p>01</p>
            </div>
          </a>
        </li>
        <li class="cart">
          <a href="./Pages/Cart.php">
            <div class="img-container">
              <img src="../Icons/cart.png" alt="custom cake icon" />
            </div>
            <p>cart</p>

            <div class="circle cart-circle">
              <p>01</p>
            </div>
          </a>
        </li>
        <li class="cart">
          <a href="http://localhost/CakeSite/src/Pages/UserAccount.php">
            <div class="img-container">
              <img src="../Icons/user.png" alt="custom cake icon" />
            </div>
            <p>account settings</p>


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
          <a href="./Pages/CustomCake.php">
            <div class="img-container">
              <img src="../Icons/custom.png" alt="custom cake icon" />
            </div>
            <p>custom cake</p>
          </a>
        </li>
        <li class="order">
          <a href="./Pages/Orders.php">
            <div class="img-container">
              <img src="../Icons/order.png" alt="custom cake icon" />
            </div>
            <p>orders</p>
            <div class="circle">
              <p>01</p>
            </div>
          </a>
        </li>
        <li class="cart">
          <a href="./Pages/Cart.php">
            <div class="img-container">
              <img src="../Icons/cart.png" alt="custom cake icon" />
            </div>
            <p>cart</p>

            <div class="circle cart-circle">
              <p>01</p>
            </div>
          </a>
        </li>

        <li class="cart">
          <a href="http://localhost/CakeSite/src/Pages/UserAccount.php">
            <div class="img-container">
              <img src="../Icons/user.png" alt="custom cake icon" />
            </div>
            <p>Your Account</p>
          </a>
        </li>
      </ul>
    </div>
  </div>

  <!-- //! --------------- SECTIONS START   -----------------  -->

  <!-- Hero-section -->
  <div class="hero-section"></div>

  <!-- ** Best-Seller-section -->
  <section class="best-seller-section">
    <h1 class="heading">Best Seller</h1>

    <!-- card-container -->
    <div class="card-container">

      <!--//* start of while loop to fetch birthday data..  -->
      <?php
      while ($row = mysqli_fetch_array($result_Of_BestSeller)) {

        // while will be fetching data here...
      ?>

        <!-- card -->
        <div class="card">
          <a href="http://localhost/CakeSite/src/Pages/Details.php?cakeID=<?php echo ($row['Cake_ID']); ?>" class="container">
            <!-- Holds image of card -->
            <div class="img-container">
              <img src="../Uploaded-Img/Cakes/<?php echo ($row['Category']) . "/" . ($row['Cake_Img'])   ?>" alt="cake image" />
            </div>

            <!-- Holds Card text -->
            <div class="content">
              <h1 class="title"><?php echo limitTextChars($row['Cake_Name'], 25, true, true) ?></h1>
              <p class="price">₹ <?php echo ($row['Price']) ?></p>
              <p class="category"><?php echo ($row['Category']) ?></p>
            </div>
          </a>
        </div>


        <!--//* End of while loop here... -->
      <?php
      }
      ?>


    </div>
  </section>

  <!--// ** Wedding Cake Section -->
  <section class="wedding-cake-section">
    <h1 class="heading">Wedding cakes</h1>

    <!-- card-container -->
    <div class="card-container">

      <!--//* start of while loop to fetch birthday data..  -->
      <?php
      while ($row = mysqli_fetch_array($result_Of_WeddingCakes)) {

        // while will be fetching data here...
      ?>

        <!-- card -->
        <div class="card">
          <a href="http://localhost/CakeSite/src/Pages/Details.php?cakeID=<?php echo ($row['Cake_ID']); ?>" class="container">
            <!-- Holds image of card -->
            <div class="img-container">
              <img src="../Uploaded-Img/Cakes/<?php echo ($row['Category']) . "/" . ($row['Cake_Img'])   ?>" alt="cake image" />
            </div>

            <!-- Holds Card text -->
            <div class="content">
              <h1 class="title"><?php echo limitTextChars($row['Cake_Name'], 25, true, true) ?></h1>
              <p class="price">₹ <?php echo ($row['Price']) ?></p>
              <p class="category"><?php echo ($row['Category']) ?></p>
            </div>
          </a>
        </div>


        <!--//* End of while loop here... -->
      <?php
      }
      ?>

  </section>

  <!--// * Premium Cake -->
  <section class="best-seller-section">
    <h1 class="heading">Premium Cakes</h1>

    <!-- card-container -->
    <div class="card-container">


      <!--//* start of while loop to fetch birthday data..  -->
      <?php
      while ($row = mysqli_fetch_array($result_Of_PremiumCakes)) {

        // while will be fetching data here...
      ?>

        <!-- card -->
        <div class="card">
          <a href="http://localhost/CakeSite/src/Pages/Details.php?cakeID=<?php echo ($row['Cake_ID']); ?>" class="container">
            <!-- Holds image of card -->
            <div class="img-container">
              <img src="../Uploaded-Img/Cakes/<?php echo ($row['Category']) . "/" . ($row['Cake_Img'])   ?>" alt="cake image" />
            </div>

            <!-- Holds Card text -->
            <div class="content">
              <h1 class="title"><?php echo limitTextChars($row['Cake_Name'], 25, true, true) ?></h1>
              <p class="price">₹ <?php echo ($row['Price']) ?></p>
              <p class="category"><?php echo ($row['Category']) ?></p>
            </div>
          </a>
        </div>



        <!--//* End of while loop here... -->
      <?php
      }
      ?>




    </div>
  </section>

  <!-- * Birthday Cake -->
  <section class="Birthday-cake-section wedding-cake-section">
    <h1 class="heading">Birthday cakes</h1>

    <!-- card-container -->
    <div class="card-container">


      <!--//* start of while loop to fetch birthday data..  -->
      <?php
      while ($row = mysqli_fetch_array($result_Of_BirthdayCakes)) {

        // while will be fetching data here...
      ?>

        <!-- card -->
        <div class="card">
          <a href="http://localhost/CakeSite/src/Pages/Details.php?cakeID=<?php echo ($row['Cake_ID']); ?>" class="container">
            <!-- Holds image of card -->
            <div class="img-container">
              <img src="../Uploaded-Img/Cakes/<?php echo ($row['Category']) . "/" . ($row['Cake_Img'])   ?>" alt="cake image" />
            </div>

            <!-- Holds Card text -->
            <div class="content">
              <h1 class="title"><?php echo limitTextChars($row['Cake_Name'], 25, true, true) ?></h1>
              <p class="price">₹ <?php echo ($row['Price']) ?></p>
              <p class="category"><?php echo ($row['Category']) ?></p>
            </div>
          </a>
        </div>



        <!--//* End of while loop here... -->
      <?php
      }
      ?>



    </div>
  </section>

  <!-- * Anniversary Cake -->
  <section class="best-seller-section">
    <h1 class="heading">Anniversary Cakes</h1>

    <!-- card-container -->
    <div class="card-container">



      <!--//* start of while loop to fetch birthday data..  -->
      <?php
      while ($row = mysqli_fetch_array($result_Of_AnniversaryCakes)) {

        // while will be fetching data here...
      ?>

        <!-- card -->
        <div class="card">
          <a href="http://localhost/CakeSite/src/Pages/Details.php?cakeID=<?php echo ($row['Cake_ID']); ?>" class="container">
            <!-- Holds image of card -->
            <div class="img-container">
              <img src="../Uploaded-Img/Cakes/<?php echo ($row['Category']) . "/" . ($row['Cake_Img'])   ?>" alt="cake image" />
            </div>

            <!-- Holds Card text -->
            <div class="content">
              <h1 class="title"><?php echo limitTextChars($row['Cake_Name'], 25, true, true) ?></h1>
              <p class="price">₹ <?php echo ($row['Price']) ?></p>
              <p class="category"><?php echo ($row['Category']) ?></p>
            </div>
          </a>
        </div>



        <!--//* End of while loop here... -->
      <?php
      }
      ?>


    </div>
  </section>

  <!-- //! ----------------- Footer ------------ -->
  <footer>
    <div class="container">
      <a href="./index.html" class="logo">
        <div class="img-container">
          <img src="../Images/Component_Img/Logo.png" alt="" />
        </div>
      </a>
      <div class="content">
        <!-- know us -->
        <div>
          <h1>know us</h1>
          <ul>
            <li><a href="./Pages/About.php">About us</a></li>
            <li><a href="./Pages/contact.php">Contact us</a></li>
          </ul>
        </div>

        <!-- more links -->
        <div>
          <h1>links</h1>
          <ul>
            <li><a href="./Pages/Orders.php">Orders</a></li>
            <li><a href="./Pages/CustomCake.php">Custom Cakes</a></li>
            <li><a href="./Pages/Cart.php">Cart</a></li>
            <li><a href="./Pages/UserAccount.php">User details</a></li>
            <li><a href="./Pages/contact.php">Contact us</a></li>
            <li><a href="./Pages/About.php">About us</a></li>
        

          </ul>
        </div>

        <!-- Find us -->
        <div class="find-us">
          <div class="social-media">
            <h1>Find us</h1>
            <a href="https://instagram.com/_craving_crumbs_?igshid=YmMyMTA2M2Y=" class="insta-icon">
              <img src="../Icons/instagram.png" alt="Insta Icon" />
              <p>Instagram</p>
            </a>
          </div>
        </div>
      </div>
    </div>
  </footer>
</body>

<!-- navigation burger btn  -->
<script src="./JS/Nav-Bar/NavBar.js"></script>
<!-- more cake navigation -->
<script src="./JS/MoreCake/MoreCake.js"></script>
<script src="./JS/notice/notice.js"></script>


</html>