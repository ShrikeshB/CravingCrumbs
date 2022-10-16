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

$cakeId = $_GET['cakeID'];


$query = "SELECT * FROM cakes WHERE Cake_ID='$cakeId';";
$result = mysqli_query($con, $query);

$row = mysqli_fetch_assoc($result);

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Craving Crumbs | Cake Details</title>
  <!-- css file linked here.. -->
  <link rel="stylesheet" href="../Style/CakeDetails/CakeDetails.css" />

  <!-- fav icon -->
  <link rel="icon" href="../../../Icons/cake-white.png" type="image/x-icon" />
</head>

<body>
  <section>
    <div class="Cake-Edit">
      <div class="container">
        <form action="http://localhost/CakeSite/Admin/PHP/UpdateCake.php?cakeID=<?php echo $cakeId; ?>" method="post" enctype="multipart/form-data">
          <!-- * Image uploader -->
          <div class="design-photo">
            <label for="file-selector">
              <div class="img-container">
                <img src="../../Uploaded-Img/Cakes/<?php echo $row['Category'] . '/' . $row['Cake_Img']; ?>" alt="" id="imgDisplayarea" />
              </div>
              <p class="btn">upload</p>
              <input onchange="showPreview(this)" type="file" name="cake-img" id="file-selector" class="cust-design-img" accept="image/png, image/jpeg, image/jpg, image/webp" />
            </label><br />
          </div>

          <div class="info">
            <p class="heading">EDIT CAKE</p>
            <!-- Cake Name -->
            <div class="input-field">
              <label for="">Cake Name</label>
              <input required name="CakeName" type="text" value="<?php echo $row['Cake_Name']; ?>" />
            </div>




            <!-- Cake Type -->
            <div class="input-field">
              <label for="">Cake Type</label>
              <input name="CakeType" type="text" value="<?php echo $row['Cake_Type']; ?>" />
            </div>

            <!-- Cream Type -->
            <div class="input-field">
              <label for="">Cream Type</label>
              <input required name="creamType" type="text" value="<?php echo $row['Cream_Type']; ?>" />
            </div>


            <!-- Cake Shape -->
            <div class=" input-field">
              <label for="">Cake Shape</label>
              <select required class="more-cake-options" name="cake-shape">
                <option selected hidden><?php echo $row['Cake_Shape']; ?></option>
                <option value="Round">Round</option>
                <option value="Triangle">Triangle</option>
                <option value="Rectangle">Rectangle</option>

              </select>
            </div>

            <!-- Cake Flavor -->
            <div class="input-field">
              <label for="">Cake Flavor</label>
              <input required name="CakeFlavor" type="text" value="<?php echo $row['Cake_Flavors']; ?>" />
            </div>

            <!-- Cake Toppings -->
            <div class="input-field">
              <label for="">Cake Toppings</label>

              <textarea required name="Toppings" id="" cols="30" rows="10"><?php echo $row['Toppings']; ?></textarea>
            </div>

            <!-- Bread Type -->
            <div class="input-field">
              <label for="">Bread Type</label>
              <input required name="BreadType" type="text" value="<?php echo $row['Bread_Type']; ?>" />
            </div>

            <!-- Category -->
            <div class="input-field">
              <label for="">Category</label>
              <select class="more-cake-options" name="category">
                <option selected hidden><?php echo $row['Category']; ?></option>
                <option value="Birthday-Cakes">Birthday cakes</option>
                <option value="Anniversary-Cake">Anniversary cakes</option>
                <option value="Wedding-Cakes">Wedding cakes</option>
                <option value="Premium-Cakes">Premium cakes</option>
                <option value="Best-Seller">Best-Seller</option>
              </select>
            </div>

            <!-- Price -->
            <div class="input-field">
              <label for="">Price for 500gram</label>
              <input placeholder="Price of cake" value="<?php echo $row['Price']; ?>" required type="number" name="price" id="" />
            </div>


            <!-- Price 1kg -->
            <div class="input-field">
              <label for="">Price for 1kg</label>
              <input placeholder="Price of cake" value="<?php echo $row['PriceOf1']; ?>" required type="number" name="price1kg" id="" />
            </div>

            <!-- Price 1.5kg-->
            <div class="input-field">
              <label for="">Price for 1.5kg</label>
              <input placeholder="Price of cake" value="<?php echo $row['PriceOf1_5']; ?>" required type="number" name="price15kg" id="" />
            </div>

            <!-- Price 2kg-->
            <div class="input-field">
              <label for="">Price for 2kg</label>
              <input placeholder="Price of cake" value="<?php echo $row['PriceOf2']; ?>" required type="number" name="price2kg" id="" />
            </div>


            <!-- Days of delivery -->
            <div class="input-field">
              <label for="">Delivery Time in days</label>
              <select name="deliveryTime">
                <option selected hidden> <?php if ($row['Order_Time'] == 1)
                                            echo $row['Order_Time'] . ' day';
                                          else
                                            echo $row['Order_Time'] . ' days'; ?></option>
                <option value="1">1 day</option>
                <option value="2">2 days</option>
              </select>
            </div>


            <!-- Cake tags -->
            <div class="input-field">
              <label for="">Tags</label>

              <textarea required name="Tags" id="" cols="30" rows="10"><?php echo $row['Tags']; ?></textarea>
            </div>

            <input required type="submit" value="Save changes" class="btn submit-btn" name="submit" />
          </div>
        </form>
      </div>
    </div>
  </section>
</body>

<!-- Jquery for preview image -->
<script type="text/javascript" src="http://code.jquery.com/jquery-1.8.2.js"></script>

<script src="../../src/JS/PreviewImage/PreviewImage.js"></script>

</html>