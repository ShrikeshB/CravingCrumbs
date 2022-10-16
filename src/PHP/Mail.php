<?php



function sendMail($to_email,$subject, $body){ 

    $headers = "From: CravingCrumbs.cakes@gmail.com"."\r\n".
                 "Content-type: text/html; charset=iso-8859-1"   ;

    if (!mail($to_email, $subject, $body, $headers)) {
      
        echo "Email sending failed...";
    }

}