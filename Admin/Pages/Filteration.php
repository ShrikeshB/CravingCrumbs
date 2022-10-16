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

$query = "SELECT * FROM cakes ORDER BY Cake_ID DESC;";
$result = mysqli_query($con, $query);



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
  <link rel="stylesheet" href="../Style/Filteration/filter.css">
  <!-- fav icon -->
  <link rel="icon" href="../../../Icons/cake-white.png" type="image/x-icon" />
</head>

<body>

  <div class="nav">

    <div class="search-btn">
      <form action="#" method="get">
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

  <div class="overlay"></div>

  <!-- ! Table Section -->
  <section>
    <p class="link">/Table</p>
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
                <h2 class="title"><?php echo limitTextChars($row['Cake_Name'], 25, true, true); ?></h2>
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


</html>