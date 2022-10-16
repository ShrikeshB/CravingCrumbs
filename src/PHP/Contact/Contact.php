<?php
if(isset($_POST['submit'])){
    $mailFrom = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    $mailTo = "CravingCrumbs.cakes@gmail.com";
    $headers = "From: ".$mailFrom."\r\n".
                 "Content-type: text/html; charset=iso-8859-1"   ;
    $msg = "From : ".$mailFrom."\n".$message;

    if( mail( $mailTo,$subject, $msg,$headers)){
        echo "<script> alert('mail submitted'); history.back(); </script>";
    }
    else{
        echo "<script> alert('mail failed to submit'); history.back(); </script>";
    }
    
}else{
    echo "<script> history.back(); </script>";
}