 <!-- ********************************************** -->
 <!-- *************** CUSTOM-CAKE PAGE *************** -->
 <!-- ********************************************** -->
 <?php

  # This file Shows UI and not store the details of order but  Custom_cake_Order.php File does..
  # If you want to access the data storing part access the Custom_cake_Order.php file.

  // to ignore notices
  error_reporting(E_ALL ^ E_NOTICE);

  // included the DB connection file
  include_once '../PHP/connectDB.php';
  include_once('../PHP/Login/LoginChecker.php');
  session_start();




  // check whether user is logged in
  if (!$_SESSION['isLogin']) {
    echo "<script> window.location='./Login.html' </script>";
  }

  ?>

 <!DOCTYPE html>
 <html lang="en">

 <head>
   <meta charset="UTF-8" />
   <meta http-equiv="X-UA-Compatible" content="IE=edge" />
   <meta name="viewport" content="width=device-width, initial-scale=1.0" />
   <title>Craving Crumb | Custom cake</title>
   <!-- fav icon -->
   <link rel="icon" href="../../Icons/cake-white.png" type="image/x-icon" />

   <!-- css file linked -->
   <link rel="stylesheet" href="../Styles/CustomCake/Custom.css" />

   <!-- responisve css file linked -->
   <link rel="stylesheet" href="../Styles/CustomCake/Resp/CustomResp.css">

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

   <!-- ************************************************** -->
   <!-- *************** img-cover-section  *************** -->
   <!-- ************************************************** -->
   <div class="cover-img"></div>

   <!-- ************************************************** -->
   <!-- *************** custom-cake-section  ************* -->
   <!-- ************************************************** -->
   <section class="custom-section">
     <h1 class="heading">Customize Cake</h1>
     <center>
       <form action="http://localhost/CakeSite/src/PHP/Custom/CustomCakeOrder.php" enctype="multipart/form-data" method="post">
         <!-- custom cake image upload -->
         <div class="design-photo">
           <p>Upload Your cake Design</p>
           <label for="file-selector">

             <img src="../../Icons/upload.png" alt="" id="imgDisplayarea" />

             <p class="btn">upload</p>
             <input required onchange="showPreview(this)" type="file" name="cake-img" id="file-selector" class="cust-design-img" accept="image/png, image/jpeg" />




           </label><br />
         </div>

         <!-- <p class="or">OR</p> -->

         <div class="custom-form">
           <div class="left">
             <!-- Cake Type -->
             <div class="input-field">
               <label for="">Cake Type</label>
               <select id="" name="cake-type">
                 <option value="Cream">Cream</option>


               </select>
             </div>

             <!-- Cake flavor -->
             <div class="input-field">
               <label for="">Cake flavor</label>
               <select id="" name="cake-flavor">
                 <option value="Cream">Cream</option>
                 <option value="mango">mango</option>
                 <option value="Vanilla">Vanilla</option>
                 <option value="Stawberry">Stawberry</option>
                 <option value="Pinapple">Pinapple</option>
               </select>
             </div>

             <!-- *  bread type -->
             <div class="input-field">
               <label for="">Bread Type</label>
               <select id="" name="bread-type">
                 <option value="chocalote">chocalote</option>

               </select>
             </div>

             <div class="bottom">
               <!-- *size -->
               <div class="size">
                 <label>Size</label>
                 <!-- custom-radio-btn -->
                 <div class="cust-radio">
                   <!-- 500 gram -->
                   <label for="myradioID">
                     <!-- default radio btn -->
                     <input type="radio" name="radio-btn" value="500gram" id="myradioID" checked="checked" />
                     <!-- outer-circle -->
                     <div class="outer-circle">
                       <p>500</p>
                     </div>
                     <p>GRAM</p>
                   </label>

                   <!-- 1 kg -->
                   <label for="1kg">
                     <!-- default radio btn -->
                     <input type="radio" value="1KG" name="radio-btn" id="1kg" />
                     <!-- outer-circle -->
                     <div class="outer-circle">
                       <p>01</p>
                     </div>
                     <p>KG</p>
                   </label>

                   <!-- 1.5 kg -->
                   <label for="1.5kg">
                     <!-- default radio btn -->
                     <input type="radio" value="1.5KG" name="radio-btn" id="1.5kg" />
                     <!-- outer-circle -->
                     <div class="outer-circle">
                       <p>1.5</p>
                     </div>
                     <p>KG</p>
                   </label>

                   <!-- 2 kg -->
                   <label for="2kg">
                     <!-- default radio btn -->
                     <input type="radio" value="2KG" name="radio-btn" id="2kg" />
                     <!-- outer-circle -->
                     <div class="outer-circle">
                       <p>02</p>
                     </div>
                     <p>KG</p>
                   </label>
                 </div>
               </div>



               <!-- *quantity of cakes -->
               <div class="input-field">
                 <label for="">Cake quantity</label>
                 <select name="quantity" id="">
                   <option value="1">Quantity 1</option>
                   <option value="2">Quantity 2</option>
                   <option value="3">Quantity 3</option>
                   <option value="4">Quantity 4</option>
                   <option value="5">Quantity 5</option>
                 </select>
               </div>
             </div>
           </div>
           <div class="right">
             <!-- cake toppings -->
             <div class="input-field">
               <label for="">Cake Toppings</label>
               <textarea required name="toppings" id="" cols="30" rows="2"></textarea>
             </div>

             <!-- cake cream -->
             <div class="input-field">
               <label for="">Cake Cream</label>
               <select name="cream-type" id="">
                 <option value="Round">Vinilla</option>

               </select>
             </div>

             <!-- cake shape -->
             <div class="input-field">
               <label for="">Cake Shape</label>
               <select name="cake-shape" id="">
                 <option value="Round">Round</option>
                 <option value="Square">Square</option>
                 <option value="Rectangle">Rectangle</option>
               </select>
             </div>

             <!-- Cake message -->
             <div class="input-field">
               <label for="">Cake Message</label>
               <input required type="text" name="message" id="" />
             </div>

             <!-- Cake Date -->
             <div class="input-field">
               <label for="">Expected Delivery on</label>
               <input required type="date" name="date" id="" />
             </div>
           </div>
         </div>
         <input type="submit" name="submit" value="Order">
       </form>
     </center>
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

 <script type="text/javascript" src="http://code.jquery.com/jquery-1.8.2.js"></script>

 <script src="../JS/Nav-Bar/NavBar.js"></script>
 <script src="../JS/PreviewImage/PreviewImage.js"></script>
 <!-- more cake navigation -->
 <script src="../JS/MoreCake/MoreCake.js"></script>

 </html>