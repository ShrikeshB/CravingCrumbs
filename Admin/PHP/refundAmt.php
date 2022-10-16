<?php
include_once '../../src/PHP/connectDB.php';
include_once '../../src/PHP/Mail.php';
$User_ID = $_GET['User_Id'];

# link copy paste issue resolve
$refund_query =  "SELECT count(*) as ct FROM refund WHERE User_ID = '$User_ID' AND Status='pending'";
$refund_result = mysqli_query($con, $refund_query);
$refund_row = mysqli_fetch_assoc($refund_result);
$count = $refund_row['ct'];


if ($User_ID != null && $count > 0) {


    $Auth_Query = "SELECT * FROM auth WHERE User_ID = '$User_ID'";
    $result_Of_Auth = mysqli_query($con, $Auth_Query);
    $auth_row = mysqli_fetch_assoc($result_Of_Auth);


    $Refunds_Query = "SELECT * FROM refund WHERE User_ID = '$User_ID' AND Status='pending'";
    $Refund_Result = mysqli_query($con, $Refunds_Query);

    $update_query = "UPDATE refund SET Status='completed' WHERE User_ID = '$User_ID'";
    $result = mysqli_query($con, $update_query);

    $amt = 0;
    while ($Refund_Row = mysqli_fetch_array($Refund_Result)) {
        if ($Refund_Row == null)
            echo "<script>  history.back()</script>";
        $amt = $amt + $Refund_Row['Amt'];
    }


    $subject = 'Your amount has been refunded';
    $body = "Your refund amount ₹" . $amt;

    if ($result) {
        sendMail($auth_row['Email'], $subject, $body);
        echo "<script> alert('Amount Refunded!'); history.back()</script>";
    } else {
        echo "<script> alert('Failed to refund amount!');history.back()</script>";
    }
} else {
    echo "<script> history.back() </script>";
}
