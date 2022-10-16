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



$query = "SELECT * FROM refunddetails ";
$result = mysqli_query($con, $query);




?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Craving Crumbs | Refund</title>

  <!-- css file linked here.. -->
  <link rel="stylesheet" href="../Style/Refund/refund.css" />


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
        <li style="background-color: black; opacity: 100%">
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
      <p class="link">/Refund</p>
    </div>



    <!-- total cake card -->

    <table cellspacing="5px">
      <tr>
        <th>Account Holder</th>
        <th>Account No.</th>
        <th>IFSC</th>
        <th>UPI</th>
        <th>Amount</th>

      </tr>

      <?php
      $amt = 0;
      while ($row = mysqli_fetch_array($result)) {

        $uid = $row['User_ID'];
        $refund_result  = mysqli_query($con, "SELECT * FROM refund WHERE User_ID = '$uid' AND Status='pending'");
        while ($refund_row = mysqli_fetch_array(($refund_result))) {
          $amt = $amt + $refund_row['Amt'];
  
        }

        # if in refund table's column(status) = 'pending' then show the user acc details..
        if ($amt >= 0 && $amt != null) {

      ?>
          <tr>
            <td><?php echo $row['Acc_Name'];  ?></td>
            <td><?php echo limitTextChars($row['Acc_No'], 15, true, true); ?></td>
            <td><?php echo $row['IFSC']; ?></td>
            <td><?php echo $row['UPI']; ?></td>
            <td><?php echo  $amt;
                $amt = 0; ?></td>
  
            <!-- <td><a href="http://localhost/CakeSite/Admin/Pages/CakeDetails.php?CakeID=<?php echo $row['Cake_ID']; ?>">View</a></td> -->
            <td style="display: flex; justify-content: space-around;">
              <a href="http://localhost/CakeSite/Admin/PHP/refundAmt.php?User_Id=<?php echo $row['User_ID'] ?>" style="width: 50%; text-align: center;" class="view">Complete</a>
            </td>

          </tr>



      <?php
        } 
      }
      ?>

    </table>


  </section>
</body>




</html>