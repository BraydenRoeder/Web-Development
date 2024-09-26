<?php

    $emailTo = "brayden3410@gmail.com";
    $subject = "Testing";
    $body = "I think you are great!";
    $header = "From: rob@robpercival.co.uk";

    if(mail($emailTo, $subject, $body, $header)){
        echo "The email was sent successfully.";
    }
    else{
        echo "The email could not be sent.";
    }

?>