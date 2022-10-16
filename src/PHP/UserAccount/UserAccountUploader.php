<?php
# upload userdetails..

//error_reporting(E_ALL ^ E_NOTICE);

// included the DB connection file
include_once '../../PHP/connectDB.php';
session_start();

$uid = $_SESSION['UserID'];
$UserDetails_Query = "select * from auth inner join userdetails on auth.User_ID=userdetails.User_ID where auth.User_ID = '$uid'; ";
$Result_UserDetails = mysqli_query($con, $UserDetails_Query);
$data = mysqli_fetch_assoc($Result_UserDetails);

if (isset($_POST['submit'])) {

    $phone = $_POST['phone'];
    $username = $_POST['username'];
    $city = $_POST['city'];
    $pincode = $_POST['pincode'];
    $state = $_POST['state'];
    $address = $_POST['address'];
    // $profile = $_FILES['profile'];  
    $file = $_FILES['profile'];
    $fileName = $_FILES['profile']['name'];
    $tmp_name = $_FILES['profile']['tmp_name'];
    $fileType = $_FILES['profile']['type'];
    $error = $_FILES['profile']['error'];


  

    if ($_SESSION['Editable']) {
        // here all the updation process is carried out...
        # if profile is uploaded
        if ($fileName != null) {



            $destination = '../../../Uploaded-Img/Profile/' . $fileName;

            $fileExt = explode('.', $fileName);
            $fileActualExt = strtolower(end($fileExt));

            $allowed = array('jpg', 'jpeg', 'png', 'webp');
            if (in_array($fileActualExt, $allowed)) {
                if ($error === 0) {
                    $fileNameNew = $uid . '.' . $fileActualExt; //create uni id
                    // $destination = 'Uploads/' . $fileNameNew;
                    $destination = '../../../Uploaded-Img/Profile/' . $fileNameNew;

                    $User_Result = mysqli_query($con,"SELECT * FROM userdetails WHERE User_ID='$uid'");
                    $userDetails_Row = mysqli_fetch_assoc($User_Result);

                    if($userDetails_Row['Profile_Img'] != 'none'){
                        $des = '../../../Uploaded-Img/Profile/' .  $userDetails_Row['Profile_Img'];
                        unlink($des);
                    }

                    if (move_uploaded_file($tmp_name, $destination)) {
                        echo ' uploaded';
                    } else {
                        echo 'failed to upload';
                    }
                } else {
                    echo 'error in file';
                }
            } else {
                echo 'cannot upload this type..';
            }

            $Update_Query = "UPDATE userdetails SET Profile_Img='$fileNameNew', Phone_No='$phone', Address='$address', City='$city', State='$state', Pincode='$pincode'  WHERE User_ID='$uid'";
        } else {
            
            if ($data['Profile_Img'] != 'none'){
                $Update_Query = "UPDATE userdetails SET Phone_No='$phone', Address='$address', City='$city', State='$state', Pincode='$pincode'  WHERE User_ID='$uid'";
             
            }
            else{
                $Update_Query = "UPDATE userdetails SET Profile_Img='none',  Phone_No='$phone', Address='$address', City='$city', State='$state', Pincode='$pincode'  WHERE User_ID='$uid'";

            
            }
        }

        $Result_update = mysqli_query($con, $Update_Query);
        //  header("location:http://localhost/CakeSite/src/Pages/UserAccount.php");
        echo "<script> history.back(); </script>";
    } else {
        if ($fileName != null) {
            echo 'no  null';
            $destination = '../../../Uploaded-Img/Custom-Cake/' . $fileName;

            $fileExt = explode('.', $fileName);
            $fileActualExt = strtolower(end($fileExt));

            $allowed = array('jpg', 'jpeg', 'png', 'webp');
            if (in_array($fileActualExt, $allowed)) {
                if ($error === 0) {
                    $fileNameNew = $uid . '.' . $fileActualExt; //create uni id
                    // $destination = 'Uploads/' . $fileNameNew;
                    $destination = '../../../Uploaded-Img/Custom-Cake/' . $fileNameNew;

                    if (move_uploaded_file($tmp_name, $destination)) {
                        echo ' uploaded';
                    } else {
                        echo 'failed to upload';
                    }
                } else {
                    echo 'error in file';
                }
            } else {
                echo 'cannot upload this type..';
            }


            $insert_details_Query = "INSERT INTO userdetails VALUES('','$uid','$fileNameNew','$phone','$address','$city','$state','$pincode')";

        } else {
            $insert_details_Query = "INSERT INTO userdetails VALUES('','$uid','none','$phone','$address','$city','$state','$pincode')";
       
        }
        $Result_insert = mysqli_query($con, $insert_details_Query);
        if ($Result_insert) {
            echo "<script> alert('Details Inserted Successfully!'); </script>";
            echo "<script> history.go(-2); </script>";
        } else {
            echo "<script> alert('Details Inserted Failed!'); </script>";
            echo "<script> history.back(); </script>";
        }
    }
}else{
    echo "<script> history.back(); </script>";
}
