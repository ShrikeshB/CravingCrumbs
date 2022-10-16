  <!-- **************************************** -->
  <!-- *************** CART PAGE ************** -->
  <!-- **************************************** -->

  <?php
  // to ignore notices
  error_reporting(E_ALL ^ E_NOTICE);

  // included the DB connection file
  include_once '../PHP/connectDB.php';
  session_start();
  if (!$_SESSION['isLogin']) {
    header("location:http://localhost/CakeSite/src/Pages/Login.html");
  }



  $UserID = $_SESSION['UserID'];
  $Cart_Query = "SELECT * FROM cart INNER JOIN cakes ON cart.Cake_ID = cakes.Cake_ID WHERE User_ID=$UserID";
  $cart_result  = mysqli_query($con, $Cart_Query);


  ?>
  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Craving Crumbs | Your cart</title>

    <!-- fav icon -->
    <link rel="icon" href="../../Icons/cake-white.png" type="image/x-icon" />
    <link rel="stylesheet" href="../Styles/cart/cart.css" />
  </head>

  <body>
    <!-- ********************************************** -->
    <!-- *************** NAVIGATION-BAR *************** -->
    <!-- ********************************************** -->
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



    <!-- ******************************************** -->
    <!-- *************** SIDE NAV BAR *************** -->
    <!-- ******************************************** -->
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


    <!-- ********************************************* -->
    <!-- *************** order-section *************** -->
    <!-- ********************************************* -->
    <section class="order-section">
      <h1 class="heading">Cart</h1>

      <div class="order-card-container">

        <?php

        while ($row = mysqli_fetch_array($cart_result)) {
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
                <p class="price">₹ <?php echo ($row['Price']) ?></p>
                <p class="category"><?php echo ($row['Category']) ?></p>
              </div>
              <div class="bottom">

                <div class="btns">
                  <a href="http://localhost/CakeSite/src/PHP/Cart/RemoveItemCart.php?cartID=<?php echo ($row['Cart_ID']) ?>" class="remove-btn">Remove</a>
                  <a href="http://localhost/CakeSite/src/Pages/Details.php?cakeID=<?php echo ($row['Cake_ID']) ?>" class="buy-btn">Buy now</a>
                </div>
              </div>
            </div>
          </div>

        <?php
        }
        ?>
      </div>
    </section>


    <!-- ************************************* -->
    <!-- *************** FOOTER ************** -->
    <!-- ************************************* -->
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
              <li><a href="../index.php">Home</a></li>
              <li><a href="../Pages/Contact.html">Contact us</a></li>
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
              <li><a href="./Contact.html">Contact us</a></li>
              <li><a href="./About.html">About us</a></li>
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