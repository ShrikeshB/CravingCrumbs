<?php

# to ignore notices
error_reporting(E_ALL ^ E_NOTICE);

# included the DB connection file
include_once '../../src/PHP/connectDB.php';

// fetch the cake ID..
$cakeID = $_GET['cakeID'];

if($cakeID != null){

    $del_qry = "DELETE FROM cakes where Cake_ID = $cakeID";
    $del_result  = mysqli_query($con, $del_qry);

    if($del_result){

        echo "<script> alert('cake Deleted Successfully!');</script> ";
        echo "<script> history.go(-1);</script> ";
     
    }else{
        
        echo "<script> alert('This cake cannot be Deleted!'); history.back(); </script> ";
        echo  mysqli_error($con);
    }
}
die();