  <!-- ************************************************ -->
  <!-- *************** CAKE DETAILS PAGE ************** -->
  <!-- ************************************************ -->
  <?php

  // *******************************
  // included the DB connection file.
  // *******************************
  include_once '../PHP/connectDB.php';

  // to ignore notices
  error_reporting(E_ALL ^ E_NOTICE);
  session_start();

  $CakeID = $_GET['cakeID']; // fetch cake ID.
  $uid = $_SESSION['UserID'];

  // ******************************************
  // Query to fetch the data as per the CaKe Id
  // ******************************************
  $Cake_Details_Query = "SELECT * FROM cakes WHERE Cake_ID='$CakeID'";
  $result_Of_Cakes_Details = mysqli_query($con, $Cake_Details_Query);

  //! check whether the item is in cart or not
  if ($_SESSION['isLogin']) {
    $cart_query = "SELECT * FROM cart WHERE User_ID=$uid AND Cake_ID=$CakeID";
    $cart_result = mysqli_query($con, $cart_query);
    $cart_row = mysqli_fetch_assoc($cart_result);
    $cart = "cart";
    if ($cart_row) {
      $cart = "added to cart";
    }
  } else {
    $cart = "cart";
  }

  // ***********************************************
  // used to get the rating of DB and makes it's avg 
  // ***********************************************
  $Review_Fetch_query = "SELECT * FROM review WHERE Cake_ID='$CakeID'";
  $Review_Result = mysqli_query($con, $Review_Fetch_query);
  $rates = 0;
  $counts = 0;
  while ($Review_Row = mysqli_fetch_array($Review_Result)) {

    $rates = $rates + $Review_Row['Rating'];
    $counts++;
  }
  //! actual rating of cake
  if ($counts > 0) // to avoid division by zero error 
    $cakeRating = $rates / $counts;
  else
    $cakeRating = 0;
  ?>


  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Craving Crumb | Details</title>
    <!-- css file linked -->
    <link rel="stylesheet" href="../Styles/Details/Details.css" />
    <!-- responsive file linked -->
    <link rel="stylesheet" href="../Styles/Details/Resp/DetailResp.css" />
    <!-- fav icon -->
    <link rel="icon" href="../../Icons/cake-white.png" type="image/x-icon" />
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

    <!-- ************************************************* -->
    <!-- *************** CAKE INFO SECTION *************** -->
    <!-- ************************************************* -->
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
            <img src="../../Uploaded-Img/Cakes/<?php echo ($row['Category']) . "/" . ($row['Cake_Img'])   ?>" alt="cake image" />
          </div>

          <!-- cake desc -->
          <div class="content">
            <!-- cake info -->
            <div class="info">
              <h1 class="title"><?php echo ($row['Cake_Name']) ?></h1>
              <h1 class="price">₹ <?php echo ($row['Price']) ?></h1>
              <p><?php echo ($row['Category']) ?></p>
              <!-- ratings -->
              <div class="stars-grp">
                <?php
                $rates_stars = 5;
                for ($i = 0; $i < $cakeRating; $i++) {
                  $rates_stars = $rates_stars - 1;

                  echo " <div class='rated'></div>";
                }

                for ($i = 0; $i < $rates_stars; $i++) {


                  echo " <div class='unrated'></div>";
                }
                echo "(No. of rating " . $counts . ")";
                ?>

              </div>




              <ul>
                <li><span>Cake Flavour :</span> <?php echo ($row['Cake_Flavors']) ?></li>
                <li><span>Type of Cake :</span> <?php echo ($row['Cake_Type']) ?></li>
                <li><span>Type of Cream :</span> <?php echo ($row['Cream_Type']) ?></li>
                <li><span>Toppings :</span> <?php echo ($row['Toppings']) ?></li>
                <li><span>Type of Bread :</span> <?php echo ($row['Bread_Type']) ?></li>
                <li> <span>Arriving on :</span><b> <?php
                                                    // create a arrving date
                                                    $Day = date("d");
                                                    $Day += $row['Order_Time'];
                                                    $arrivingDate = $Day . '-' . date("m-Y");
                                                    $_SESSION['arriving'] = $arrivingDate;
                                                    echo $arrivingDate; ?></b>
                </li>
              </ul>
            </div>
          <?php } ?>


          <!-- custom form -->
          <form action="http://localhost/CakeSite/src/PHP/BuyCartChecker.php?CakeID=<?php echo $CakeID; ?>" method="post">
            <!-- *size -->
            <div class="size">
              <h3>Size</h3>
              <!-- custom-radio-btn -->
              <div class="cust-radio">
                <!-- 500 gram -->
                <label for="myradioID">
                  <!-- default radio btn -->
                  <input type="radio" value="500gram" name="radio-btn" id="myradioID" checked="checked" />
                  <!-- outer-circle -->
                  <div class="outer-circle">
                    <p>500</p>
                  </div>
                  <p>GRAM</p>
                </label>

                <!-- 1 kg -->
                <label for="1kg">
                  <!-- default radio btn -->
                  <input type="radio" value="1kg" name="radio-btn" id="1kg" />
                  <!-- outer-circle -->
                  <div class="outer-circle">
                    <p>01</p>
                  </div>
                  <p>KG</p>
                </label>

                <!-- 1.5 kg -->
                <label for="1.5kg">
                  <!-- default radio btn -->
                  <input type="radio" value="1.5kg" name="radio-btn" id="1.5kg" />
                  <!-- outer-circle -->
                  <div class="outer-circle">
                    <p>1.5</p>
                  </div>
                  <p>KG</p>
                </label>

                <!-- 2 kg -->
                <label for="2kg">
                  <!-- default radio btn -->
                  <input type="radio" value="2kg" name="radio-btn" id="2kg" />
                  <!-- outer-circle -->
                  <div class="outer-circle">
                    <p>02</p>
                  </div>
                  <p>KG</p>
                </label>
              </div>
            </div>

            <!-- *quantity of cakes -->
            <select name="quantity" name="quantity" id="">
              <option value="1">Quantity 1</option>
              <option value="2">Quantity 2</option>
              <option value="3">Quantity 3</option>
              <option value="4">Quantity 4</option>
              <option value="5">Quantity 5</option>
            </select>

            <input type="text" name="msg" class="msg" required placeholder="message on cake" />

            <div class="btns">
              <input type="submit" value="Buy" class="buy-btn" name="buy" />
              <a href="http://localhost/CakeSite/src/PHP/ItemToCart.php?cakeID=<?php echo $CakeID ?>" class="cart-btn" name="cart"><?php echo $cart ?></a>
            </div>
          </form>
          </div>





      </div>
    </section>

    <hr>

    <!-- *************************************************** -->
    <!-- *************** CAKE REVIEW SECTION *************** -->
    <!-- *************************************************** -->
    <section class="review-section">
      <h1 class="heading">Reviews</h1><br><br>
      <div class="review-container">


        <?php
        //! PHP CODE HERE...
        $Review_Fetch_query = "SELECT * FROM review INNER JOIN auth ON review.User_ID=auth.User_ID WHERE Cake_ID='$CakeID'";
        $Review_Result = mysqli_query($con, $Review_Fetch_query);

        while ($Review_Row = mysqli_fetch_array($Review_Result)) {
          $id = $Review_Row['User_ID'];

          $userDetails_query = "SELECT * FROM userdetails WHERE User_ID='$id'";
          $userDetails_result  = mysqli_query($con, $userDetails_query);
          $userDetails = mysqli_fetch_assoc($userDetails_result);


        ?>

          <!-- *review-card -->
          <div class="review-card">
            <!-- user profile -->
            <div class="user-profile">
              <div class="img-container">
                <img src="<?php
                          if ($userDetails['Profile_Img'] != 'none') {
                            echo "../../Uploaded-Img/Profile/" . $userDetails['Profile_Img'];
                          } else {
                            echo '../../Icons/user.png';
                          }

                          ?>" alt="user-icon" />
              </div>
              <p class="uname"><?php echo $Review_Row['Username'] ?></p>
            </div>

            <!-- ratings -->
            <div class="stars-grp">
              <?php
              $rates_stars = 5;
              for ($i = 0; $i < $Review_Row['Rating']; $i++) {
                $rates_stars = $rates_stars - 1;

                echo " <div class='rated'></div>";
              }

              for ($i = 0; $i < $rates_stars; $i++) {


                echo " <div class='unrated'></div>";
              }
              ?>

            </div>
            <!-- user review -->
            <p class="review">
              <?php echo $Review_Row['Review'] ?>
            </p>
          </div>


        <?php } ?>
      </div>
    </section>

    <hr>

    <!-- ******************************************************* -->
    <!-- *************** CAKE SUGGESTION SECTION *************** -->
    <!-- ******************************************************* -->
    <section class="suggestion-section">
      <h1 class="heading">Similar Cakes</h1>

      <!-- card-container -->
      <div class="card-container">



        <?php
        //query to select the similar cakes...
        $Similar_Cakes_Query = "SELECT * FROM cakes WHERE category='$cakeCategory' LIMIT 6";
        $result_Of_SimilarCakes = mysqli_query($con, $Similar_Cakes_Query);

        while ($row = mysqli_fetch_array($result_Of_SimilarCakes)) {


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
        }
        ?>

      </div>
    </section>

    <!-- ************************************* -->
    <!-- *************** FOOTER ************** -->
    <!-- ************************************* -->
    <footer>
      <div class="container">
        <a href="./index.html" class="logo">
          <div class="img-container">
            <img src="../../Images/Component_Img/Logo.png" alt="" />
          </div>
        </a>
        <div class="content">
          <!-- know us -->
          <div>
            <h1>know us</h1>
            <ul>
              <li><a href="../index.html">Home</a></li>
              <li><a href="../Pages/Contact.html">Contact us</a></li>
            </ul>
          </div>

          <!-- more links -->
          <div>
            <h1>links</h1>
            <ul>
              <li><a href="../Pages/Orders.html">Orders</a></li>
              <li><a href="../Pages/CustomCake.php">Custom Cakes</a></li>
              <li><a href="../Pages/Cart.html">Cart</a></li>
              <li><a href="../Pages/UserAccount.html">User details</a></li>
              <li><a href="../Pages/Contact.html">Contact us</a></li>
              <li><a href="../Pages/About.html">About us</a></li>
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