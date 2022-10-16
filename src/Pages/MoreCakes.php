<?php
// included the DB connection file
include_once '../PHP/connectDB.php';
session_start();

$category = $_GET['category'];



//query to select the data fom best seller cakes
$SearchQuery = "SELECT * FROM cakes WHERE Category = '$category'";
$result_Of_Search = mysqli_query($con, $SearchQuery);

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Craving Crumb | MoreCakes</title>

  <!-- Css Main File Linked -->
  <link rel="stylesheet" href="../Styles/Home/main.css" />
  <!-- Css nav-bar file Linked -->
  <link rel="stylesheet" href="../Styles/Navbar/Navbar.css" />
  <!-- responsive file linked -->
  <link rel="stylesheet" href="../Styles/Home/Resp/mainResp.css">


  <!-- fav icon -->
  <link rel="icon" href="../../Icons/cake-white.png" type="image/x-icon" />
</head>

<body>
  <!-- //! ------------- navigation-Bar ---------------------- -->
  <div class="navigation">
    <a href="http://localhost/CakeSite/src/index.php" class="logo">
      <div class="img-container">
        <img src="../../Images/Component_Img/Logo.png" alt="" />
      </div>
    </a>

    <!-- search btn & more cake options -->
    <div class="btns-fields">
      <div class="input-container">
        <!-- search-btn -->
        <div class="search-btn">
          <form action="http://localhost/CakeSite/src/Pages/search.php" method="post">
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

  <!-- //! --------------- SECTIONS START   -----------------  -->




  <!-- ** Best-Seller-section -->
  <section class="best-seller-section">
    <h1 class="heading" style="font-size: 18px; margin-top:2em;">Search Results for "<?php echo ($category); ?>" </h1>

    <!-- card-container -->
    <div class="card-container">

      <!--//* start of while loop to fetch birthday data..  -->
      <?php
      while ($row = mysqli_fetch_array($result_Of_Search)) {

        // while will be fetching data here...  

      ?>

        <!-- card -->
        <div class="card">
          <a href="http://localhost/CakeSite/src/Pages/Details.php?cakeID=<?php echo ($row['Cake_ID']); ?>" class="container">
            <!-- Holds image of card -->
            <div class="img-container">
              <img src="../../Uploaded-Img/Cakes/<?php echo ($row['Category']) . "/" . ($row['Cake_Img'])   ?>" alt="cake image" />
            </div>

            <!-- Holds Card text -->
            <div class="content">
              <h1 class="title"><?php echo ($row['Cake_Name']) ?></h1>
              <p class="price">₹ <?php echo ($row['Price']) ?></p>
              <p class="category"><?php echo ($row['Category']) ?></p>
            </div>
          </a>
        </div>


        <!--//* End of while loop here... -->
      <?php

      } // end of while
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