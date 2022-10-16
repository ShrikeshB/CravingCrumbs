<?php
// to ignore notices
error_reporting(E_ALL ^ E_NOTICE);

// included the DB connection file
include_once '../../src/PHP/connectDB.php';
include_once '../../src/PHP/CharLimits/CharLimits.php';

session_start();
if (!$_SESSION['IsAdminLogged']) {
  header("Location:./Login.html");
}

// Admin data
$Admin_ID = $_SESSION['AdminID'];
$Admin_data = "SELECT * FROM admin WHERE Admin_ID='$Admin_ID'";
$Admin_result = mysqli_query($con, $Admin_data);
$Admin_row = mysqli_fetch_assoc($Admin_result);

$isSearch = false;
$isMoreCake = false;

// if it is search
if (isset($_GET['search'])) {
  $searchKey = $_GET['searchField'];
  $query = "SELECT * FROM cakes WHERE Cake_Name LIKE '%{$searchKey}%' OR Tags LIKE '%{$searchKey}%' OR Category  LIKE '%{$searchKey}%'";
  $result = mysqli_query($con, $query);
  $isSearch = true;
  $isMoreCake = false;
} 
// if it is more cake filteration
else if ($_GET['category'] != null) {
  $category = $_GET['category'];
  $query = "SELECT * FROM cakes WHERE Category = '$category'";
  $result = mysqli_query($con, $query);
  $isMoreCake = true;
} 
// complete data display
else {
  $query = "SELECT * FROM cakes ORDER BY Cake_ID DESC;";
  $result = mysqli_query($con, $query);
  $isSearch = false;
  $isMoreCake = false;
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Craving Crumbs | Table</title>

  <!-- css file linked here.. -->
  <link rel="stylesheet" href="../Style/Tables/Tables.css" />

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

                                              echo substr($username, 0, 1) ?></p>
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
        <li style="background-color: black; opacity: 100%">
          <a href="#">
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

  <!-- ! Table Section -->
  <section>
    <div class="filter">
      <p class="link">/Table <?php
       if ($isSearch == true) echo "/search result of '" . $searchKey . "'"; 
       else if( $isMoreCake ) echo "/" . $category; 
       ?></p>
    </div>

    <!-- Filteration -->
    <div class="nav">

      <div class="search-btn">
        <form action="http://localhost/CakeSite/Admin/Pages/Tables.php" method="get">
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

    </div>


    <!-- total cake card -->

    <table cellspacing="5px">
      <tr>
        <th>ID</th>
        <th>Cake</th>
        <th>Cake Type</th>
        <th>Cake Shape</th>
        <th>Cake Flavor</th>
        <th>Toppings</th>
        <th>Bread Type</th>
        <th>Price</th>
        <th>Category</th>
        <th>Delivery Time</th>
      </tr>

      <?php
      while ($row = mysqli_fetch_array($result)) {


      ?>
        <tr>
          <td><?php echo $row['Cake_ID'];  ?></td>
          <td><?php echo limitTextChars($row['Cake_Name'], 15, true, true); ?></td>
          <td><?php echo $row['Cake_Type']; ?></td>
          <td><?php echo $row['Cake_Shape']; ?></td>
          <td><?php echo $row['Cake_Flavors']; ?></td>
          <td><?php echo limitTextChars($row['Toppings'], 10, true, true)  ?></td>
          <td><?php echo $row['Bread_Type']; ?></td>
          <td><?php echo '₹ ' . $row['Price']; ?></td>
          <td><?php echo $row['Category']; ?></td>
          <td><?php

              if ($row['Order_Time'] == 1)
                echo $row['Order_Time'] . ' day';
              else
                echo $row['Order_Time'] . ' days';
              ?></td>
          <!-- <td><a href="http://localhost/CakeSite/Admin/Pages/CakeDetails.php?CakeID=<?php echo $row['Cake_ID']; ?>">View</a></td> -->
          <td>
            <div data-viewIndex="<?php echo $row['Cake_ID']; ?>" class="view">View</div>
          </td>

        </tr>


        <div class="float-card" data-Floatindex="<?php echo $row['Cake_ID']; ?>">

          <div class="close-btn" onclick="close1()">
            <div class="line l1"></div>
            <div class="line l2"></div>
          </div>

          <div class="container">
            <div class="info">
              <!-- cake image -->
              <div class="img-container">
                <img src="../../Uploaded-Img/Cakes/<?php echo $row['Category'] . "/" . $row['Cake_Img']; ?>" alt="cake image">
              </div>

              <!-- cake info -->
              <div class="content">
                <h2 class="title"><?php echo limitTextChars($row['Cake_Name'], 30, true, true); ?></h2>
                <ul>
                  <li class="price"><span>Price :</span> <?php echo '₹ ' . ($row['Price']) ?></li>
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
                <div class="btns">

                  <a href="http://localhost/CakeSite/Admin/Pages/CakeDetails.php?cakeID=<?php echo $row['Cake_ID']; ?>" class="btn Edit-btn">Edit</a>
                  <a href="http://localhost/CakeSite/Admin/PHP/DeleteCake.php?cakeID=<?php echo $row['Cake_ID']; ?>" class="btn Del-btn">Delete</a>
                </div>
              </div>
            </div>
          </div>

        </div>

      <?php
      }
      ?>

    </table>


  </section>
</body>
<!-- <script type="text/javascript" src="http://code.jquery.com/jquery-1.8.2.js"></script> -->

<script src="../JS/floatCard.js"></script>
<script src="../JS/morecake.js"></script>


</html>