<?php
// to ignore notices
error_reporting(E_ALL ^ E_NOTICE);

// included the DB connection file
include_once '../../src/PHP/connectDB.php';

session_start();
if (!$_SESSION['IsAdminLogged']) {
  header("Location:./Login.html");
}

// Admin data
$Admin_ID = $_SESSION['AdminID'];
$Admin_data = "SELECT * FROM admin WHERE Admin_ID='$Admin_ID'";
$Admin_result = mysqli_query($con,$Admin_data);
$Admin_row = mysqli_fetch_assoc($Admin_result);

if (isset($_POST['submit'])) {

  // image data
  $file = $_FILES['cake-img'];
  $fileName = $_FILES['cake-img']['name'];
  $tmp_name = $_FILES['cake-img']['tmp_name'];
  $fileType = $_FILES['cake-img']['type'];
  $error = $_FILES['cake-img']['error'];

  // form data
  $category = $_POST['category'];
  $cakeType = $_POST['cake-type'];
  $creamType = $_POST['cream-type'];
  $toppings = $_POST['toppings'];
  $breadType = $_POST['bread-type'];
  $cakeShape = $_POST['cake-shape'];
  $price500 = $_POST['500price'];
  $price1 = $_POST['1price'];
  $price15 = $_POST['1-5price'];
  $price2 = $_POST['2price'];
  $cakeFlavor = $_POST['cake-flavor'];
  $cakeName = $_POST['cake-name'];
  $tags = $_POST['tags'];
  $deliveryTime = $_POST['deliveryTime'];

  $destination = '../../Uploaded-Img/Cakes/' . $category . '/' . $fileName;



  $InsertQuery = "INSERT INTO cakes VALUES('','$fileName','$cakeName','$price500',' $price1','$price15',' $price2','$cakeFlavor','$cakeType','$creamType','$toppings','$breadType','$cakeShape','$category','$deliveryTime','$tags')";
  $Query_result = mysqli_query($con, $InsertQuery);

  if ($Query_result) {

    // used to upload images
    if (move_uploaded_file($tmp_name, $destination)) {
      echo "<script> console.log('uploaded') </script>";
    } else {
      echo "<script> console.log('failed to upload') </script>";
    }

    echo "<script> alert('Cake Added'); </script>";
    echo "<script> history.back() </script>";
  } else {
    echo "<script> alert('Failed to add cake!'); </script>";
    // header("location:http://localhost/CakeSite/Admin/Pages/Newitems.php");
    echo "<script> history.back() </script>";
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Craving Crumbs | New Items</title>

  <!-- css file linked here.. -->
  <link rel="stylesheet" href="../Style/NewItems/NewItem.css" />

  <!-- fav icon -->
  <link rel="icon" href="../../../Icons/cake-white.png" type="image/x-icon" />
</head>

<body>
  <!-- ! ----------- Side Navigation bar --------------- -->
  <div class="side-navigation">
    <div class="admin-info">
      <div class="profile-img">
      <p style="text-transform: uppercase;"><?php
          $username = $Admin_row['Username'];
          
          echo substr($username,0,1) ?></p>
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
        <li style="background-color: black; opacity: 100%">
          <a href="#">
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

  <!-- //! -------------- Nav bar --------------------------------->
  <div class="nav-bar">
    <div class="logo"><img src="../Icons/Logo.png" alt="" /></div>
    <a href="../PHP/Logout.php" class="logout">Logout</a>
  </div>

  <!--//!-----------------  New Items Section --------------------->
  <section>
    <p class="link">/New Items</p>

    <!-- Insert cake form -->
    <form action="http://localhost/CakeSite/Admin/Pages/NewItems.php" method="post" enctype="multipart/form-data">

      <!-- * Image uploader -->
      <div class="design-photo">

        <label for="file-selector">
          <img src="../../Icons/upload.png" alt="" id="imgDisplayarea" />

          <p class="btn">upload</p>
          <input required onchange="showPreview(this)" type="file" name="cake-img" id="file-selector" class="cust-design-img" accept="image/png, image/jpeg, image/jpg, image/webp" />
        </label><br />
        <p>Upload Cake Image</p>
      </div>

      <!-- * Input fields -->
      <!-- cake name -->
      <div class="input-field">
        <label for="">Cake Name</label>
        <input required type="text" name="cake-name" id="" />
      </div>

      <div class="input-field">
        <label for="">Cake Flavor</label>
        <input required type="text" name="cake-flavor" id="" />
      </div>

      <!-- cake type -->
      <div class="input-field">
        <label for="">Cake type</label>
        <input required type="text" name="cake-type" id="" />
      </div>

      <!-- cream type -->
      <div class="input-field">
        <label for="">Cream type</label>
        <input required type="text" name="cream-type" id="" />
      </div>
      <!-- Toppings -->
      <div class="input-field">
        <label for="">Toppings</label>
        <input required type="text" name="toppings" id="" />
      </div>
      <!-- Bread type -->
      <div class="input-field">
        <label for="">Bread type</label>
        <input required type="text" name="bread-type" id="" />
      </div>
      <!-- Cake Shape -->
      <div class="input-field">
        <label for="">Cake Shape</label>
        <select required class="more-cake-options" name="cake-shape">
          <option value="Round">Round</option>
          <option value="Square">Square</option>
          <option value="Rectangle">Rectangle</option>

        </select>

      </div>
      <!-- Price -->
      <div class="input-field">
        <label for="">Price of 500gram cake</label>
        <input required type="number" name="500price" id="" />
      </div>

      <div class="input-field">
        <label for="">Price of 1KG cake</label>
        <input required type="number" name="1price" id="" />
      </div>

      <div class="input-field">
        <label for="">Price of 1.5KG cake</label>
        <input required type="number" name="1-5price" id="" />
      </div>

      <div class="input-field">
        <label for="">Price of 2KG cake</label>
        <input required type="number" name="2price" id="" />
      </div>
      <!-- Days of delivery -->
      <div class="input-field">
        <label for="">Delivery Time in days</label>
        <select class="more-cake-options" onchange="Morecakes()" name="deliveryTime">
          <option value="1">1 day</option>
          <option value="2">2 day</option>

        </select>
      </div>
      <!-- Category -->
      <div class="input-field">
        <label for="">Category</label>
        <select class="more-cake-options" onchange="Morecakes()" name="category">
          <option value="Birthday-Cakes">Birthday cakes</option>
          <option value="Anniversary-Cake">Anniversary cakes</option>
          <option value="Wedding-Cakes">Wedding cakes</option>
          <option value="Premium-Cakes">Premium cakes</option>
          <option value="Best-Seller">Best-Seller</option>
        </select>
      </div>

      <!-- Tags -->
      <div class="input-field">
        <label for="">Tags(sperate them with comma)</label>
        <textarea required placeholder="Example: round cake, chocolate cake, vinilla bread" name="tags" id="" cols="30" rows="10"></textarea>
      </div>

      <input required type="submit" value="Add cake" class="cust-submit-btn" name="submit">
    </form>
  </section>
</body>

<!-- Jquery for preview image -->
<script type="text/javascript" src="http://code.jquery.com/jquery-1.8.2.js"></script>

<script src="../../src/JS/PreviewImage/PreviewImage.js"></script>

</html>